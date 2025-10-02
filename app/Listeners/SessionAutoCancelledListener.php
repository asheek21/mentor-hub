<?php

namespace App\Listeners;

use App\Enums\BookingStatus;
use App\Events\SessionCancelled;
use App\Models\User;
use App\Notifications\SessionAutoCancelledMenteeNotification;
use App\Notifications\SessionAutoCancelledMentorNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SessionAutoCancelledListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SessionCancelled $event): void
    {
        $booking = $event->booking;

        $bookingStatus = $event->bookingStatus;

        if ($bookingStatus != BookingStatus::AUTOCANCELLED) {
            return;
        }

        $booking->loadMissing('mentee', 'mentor');

        /** @var User $mentee */
        $mentee = $booking->mentee;

        /** @var User $mentor */
        $mentor = $booking->mentor;

        $mentee->notify((new SessionAutoCancelledMenteeNotification($booking))->delay(now()->addSeconds(40)));

        $mentor->notify((new SessionAutoCancelledMentorNotification($booking))->delay(now()->addSeconds(90)));
    }
}
