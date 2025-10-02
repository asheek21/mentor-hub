<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionAutoCancelledMentorNotification extends Notification
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
            ->line('A booking was auto-cancelled.')
            ->view('emails.mentor-booking-auto-cancelled', [
                'title' => 'A booking was auto-cancelled.',
                'name' => $notifiable->first_name,
                'booking' => $this->booking,
                'mentee' => $this->booking->mentee,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(User $notifiable): array
    {
        return [
            'title' => 'Your booking was automatically cancelled',
            'body' => "Your booking (ID {$this->booking->reference_number}) scheduled for {$this->booking->schedule->toDateTimeString()} was auto-cancelled.",
            'action' => route('sessions', ['tab' => 'cancelled']),
        ];
    }
}
