<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionAutoCancelledMenteeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Booking $booking)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Your booking was automatically cancelled.')
            ->view('emails.mentee-booking-auto-cancelled', [
                'title' => 'Your booking was automatically cancelled.',
                'name' => $notifiable->first_name,
                'booking' => $this->booking,
                'mentor' => $this->booking->mentor,
            ]);
    }

    public function toDatabase(User $notifiable)
    {
        return [
            'title' => 'Your booking was automatically cancelled',
            'body' => "Your booking (ID {$this->booking->reference_number}) scheduled for {$this->booking->schedule->toDateTimeString()} was auto-cancelled. You can reschedule or request a refund from your sessions.",
            'action' => route('sessions', ['tab' => 'cancelled']),
        ];
    }
}
