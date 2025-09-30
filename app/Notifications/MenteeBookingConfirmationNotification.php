<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class MenteeBookingConfirmationNotification extends Notification implements ShouldQueue
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

    public function toMail(User $notifiable): MailMessage
    {
        $name = $notifiable->full_name;

        $mentor = $this->booking->mentor;

        return (new MailMessage)
            ->subject('Hang Tight! Your Session Is Awaiting Mentor Confirmation')
            ->view('emails.mentee-booking-confirmation', [
                'title' => 'Hang Tight! Your Session Is Awaiting Mentor Confirmation',
                'name' => $name,
                'booking' => $this->booking,
                'mentor' => $mentor,
            ]);
    }

    public function toDatabase(User $notifiable): array
    {
        return [
            'title' => 'Session Requested – Awaiting Mentor Approval',
            'body' => 'Your mentorship session on '.Carbon::parse($this->booking->schedule)->format('l, F j, Y \a\t g:i A').' has been requested and is pending mentor approval. You’ll be notified once it’s confirmed.',
            'action' => '/booking/view/'.$this->booking->id,
        ];
    }
}
