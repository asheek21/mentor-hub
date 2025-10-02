<?php

namespace App\Listeners;

use App\Events\PaymentReceived;
use App\Models\User;
use App\Notifications\MenteeBookingConfirmationNotification;
use App\Notifications\MentorBookingConfirmationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentPaymentReceivedNotification implements ShouldQueue
{
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
    public function handle(PaymentReceived $event): void
    {
        $booking = $event->booking;

        /** @var User $mentee */
        $mentee = $booking->mentee;

        /** @var User $mentor */
        $mentor = $booking->mentor;

        $mentee->notify(new MenteeBookingConfirmationNotification($booking));

        $mentor->notify((new MentorBookingConfirmationNotification($booking))->delay(now()->addSeconds(30)));

    }
}
