<?php

namespace App\Livewire\Booking;

use App\Actions\Booking\CreateBookingAction;
use App\Actions\Booking\UpdateMenteeBookingSessionAction;
use App\Enums\BookingPaymentStatus;
use App\Enums\MenteeBookingSessionStatus;
use App\Livewire\Components\PaymentModal;
use App\Models\Booking;
use App\Models\MenteeBookingSession;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class BookingPage extends Component
{
    use WithFileUploads;

    #[Url('mSid')]
    public string $menteeProfileUuid = '';

    public User $mentor;

    public MenteeBookingSession $menteeBookingSession;

    public string $selectedDate = '';

    public string $selectedTimeSlot = '';

    public array $upload_files = [];

    public string $meeting_notes = '';

    public array $all_files = [];

    public bool $loadingCheckout = false;

    #[Url('session_id')]
    public string $stripe_session_id = '';

    public function mount()
    {
        /** @var MenteeBookingSession|null $menteeBookingSession */
        $menteeBookingSession = MenteeBookingSession::findByUuid($this->menteeProfileUuid);

        /** @var User|null $mentor */
        $mentor = $menteeBookingSession?->mentor;

        if (! $menteeBookingSession) {
            Toaster::warning('Session Expired');

            return $mentor ? $this->redirect(route('mentor.profile', $mentor)) : $this->redirect(route('browse-mentors'));
        }

        if (! empty($this->stripe_session_id)) {

            $menteeBookingSession->update([
                'status' => MenteeBookingSessionStatus::COMPLETED,
            ]);

            Booking::where('mentee_booking_session_uuid', $menteeBookingSession->uuid)->update([
                'status' => BookingPaymentStatus::INITIATED,
            ]);

            Session::put('booking_status', [
                'mentee_booking_session_id' => $menteeBookingSession->uuid,
                'stripe_session_id' => $this->stripe_session_id,
            ]);

            return $this->redirect(route('mentor.booking.verification').'?mSid='.$menteeBookingSession->uuid);
        }

        if (! $menteeBookingSession->isValid()) {

            Toaster::warning('Session Expired');

            return $mentor ? $this->redirect(route('mentor.profile', $mentor)) : $this->redirect(route('browse-mentors'));
        }

        $this->mentor = $mentor;

        $this->mentor->load('mentorProfile', 'mentorSchedule');

        $this->menteeBookingSession = $menteeBookingSession;
    }

    public function render()
    {
        return view('livewire.booking.booking-page');
    }

    #[On('invalidate-session')]
    public function invalidateSession()
    {
        Toaster::warning('Session Expired');

        $this->menteeBookingSession->invalidate();

        $this->redirect(route('mentor.profile', $this->mentor));
    }

    #[On('selected-time-date')]
    public function selectedTimeAndDate(array $slot)
    {
        $this->selectedDate = $slot['date'];

        $this->selectedTimeSlot = $slot['time'];
    }

    public function bookSession()
    {
        if (empty($this->selectedDate) || empty($this->selectedTimeSlot)) {
            $this->addError('selectedDate', 'Please select a date and time');

            return;
        }

        $this->validate();

        $this->loadingCheckout = true;

        $booking = app(CreateBookingAction::class)->execute($this->mentor, $this->menteeBookingSession, [
            'date' => $this->selectedDate,
            'time' => $this->selectedTimeSlot,
            'meetingNote' => $this->meeting_notes,
            'files' => $this->all_files,
        ]);

        app(UpdateMenteeBookingSessionAction::class)->execute($this->menteeBookingSession, [
            'slot' => Carbon::parse($this->selectedDate.' '.$this->selectedTimeSlot, 'Asia/Kolkata')->format('Y-m-d H:i:s'),
        ]);

        $this->dispatch('open-checkout-modal', $booking->id)->to(PaymentModal::class);
    }

    protected function rules()
    {
        return [
            'meeting_notes' => 'nullable|string',
            'upload_files' => 'nullable|array',
        ];
    }

    public function updatedUploadFiles($files)
    {
        foreach ($files as $file) {
            // Get file size in MB
            $fileSizeMB = $file->getSize() / 1024 / 1024;

            // Manual validation
            if ($fileSizeMB > 2) {
                $this->addError('all_files', "{$file->getClientOriginalName()} exceeds the 2MB limit.");

                continue; // Skip adding this file
            }

            // Optional: check mime type manually
            $allowedMimeTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'image/jpeg', 'image/png'];
            if (! in_array($file->getMimeType(), $allowedMimeTypes)) {
                $this->addError('all_files', "{$file->getClientOriginalName()} has an invalid file type.");

                continue;
            }

            $this->all_files[] = $file;
        }

        $this->upload_files = [];
    }

    public function removeFile($index)
    {
        unset($this->all_files[$index]);

        $this->all_files = array_values($this->all_files);
    }

    #[On('checkout-closed')]
    public function checkoutClosed()
    {
        $this->loadingCheckout = false;
    }
}
