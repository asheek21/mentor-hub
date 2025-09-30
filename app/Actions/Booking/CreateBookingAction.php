<?php

namespace App\Actions\Booking;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\MenteeBookingSession;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateBookingAction
{
    public function execute(User $mentor, MenteeBookingSession $menteeBookingSession, array $data): Booking
    {

        $mentee = Auth::user();

        $duration = $mentor->mentorProfile->session_duration;

        $schedule = Carbon::parse($data['date'].' '.$data['time'], 'Asia/Kolkata')->format('Y-m-d H:i:s');

        /** @var Booking $booking */
        $booking = $mentee->menteeBookings()->create([
            'mentor_id' => $mentor->id,
            'mentee_booking_session_uuid' => $menteeBookingSession->uuid,
            'price' => $menteeBookingSession->price,
            'status' => BookingStatus::PENDING,
            'schedule' => $schedule,
            'duration' => $duration,
            'meeting_notes' => $data['meetingNote'],
            'amount' => $menteeBookingSession->price,
            'reference_number' => strtoupper(uniqid('BK-')),
        ]);

        app(DeletePreviousBookingAction::class)->execute($mentee, $menteeBookingSession, $booking);

        $files = $data['files'] ?? [];

        foreach ($files as $file) {
            $booking->addMedia($file)->toMediaCollection(Booking::MEDIA_LIBRARY_FILES);
        }

        return $booking;
    }
}
