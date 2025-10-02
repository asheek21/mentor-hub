<?php

namespace App\Livewire\Booking;

use App\Actions\Booking\CreateBookingTransactionAction;
use App\Enums\MenteeBookingSessionStatus;
use App\Models\Booking;
use App\Models\MenteeBookingSession;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Verification extends Component
{
    #[Url('mSid')]
    public string $menteeProfileUuid = '';

    public MenteeBookingSession $menteeBookingSession;

    public User $mentor;

    public Booking $booking;

    public function mount()
    {
        /** @var MenteeBookingSession|null $menteeBookingSession */
        $menteeBookingSession = MenteeBookingSession::findByUuid($this->menteeProfileUuid);

        /** @var User|null $mentor */
        $mentor = $menteeBookingSession?->mentor;

        if (! $menteeBookingSession || $menteeBookingSession->status !== MenteeBookingSessionStatus::COMPLETED) {
            Toaster::warning('Invalid Session');

            return $mentor ? $this->redirect(route('mentor.profile', $mentor)) : $this->redirect(route('browse-mentors'));
        }

        $sessionData = Session::get('booking_status');

        if (! $sessionData || ($sessionData['mentee_booking_session_id'] !== $menteeBookingSession->uuid)) {
            Toaster::warning('Invalid Session');

            return $mentor ? $this->redirect(route('mentor.profile', $mentor)) : $this->redirect(route('browse-mentors'));
        }

        $this->booking = $menteeBookingSession->booking;

        $this->mentor = $mentor;

        $this->menteeBookingSession = $menteeBookingSession;

        $stripeSession = $sessionData['stripe_session_id'];

        app(CreateBookingTransactionAction::class)->execute($this->booking, $stripeSession);

    }

    public function getListeners()
    {
        return [
            "echo-private:booking.{$this->booking->id},PaymentReceived" => 'paymentReceived',
        ];
    }

    public function render()
    {
        return view('livewire.booking.verification');
    }

    public function paymentReceived($event)
    {
        $this->dispatch('paymentReceived');
    }

    #[On('redirect-success')]
    public function redirectToSuccessPage()
    {
        return Redirect::route('sessions', [
            'tab' => 'upcoming',
        ]);
    }
}
