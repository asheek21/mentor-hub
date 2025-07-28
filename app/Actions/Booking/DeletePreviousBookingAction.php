<?php

namespace App\Actions\Booking;

use App\Models\Booking;
use App\Models\MenteeBookingSession;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeletePreviousBookingAction
{
    public function execute(User $mentee, MenteeBookingSession $menteeBookingSession, Booking $currentBooking): void
    {
        defer(function () use ($mentee, $menteeBookingSession, $currentBooking) {
            $previousBookings = $mentee->menteeBookings()
                ->where('id', '!=', $currentBooking->id)
                ->where('mentee_booking_session_uuid', $menteeBookingSession->uuid)->get();

            Media::where('model_type', Booking::class)
                ->whereIn('model_id', $previousBookings->pluck('id'))->delete();

            foreach ($previousBookings as $booking) {
                $booking->delete();
            }
        });

    }
}
