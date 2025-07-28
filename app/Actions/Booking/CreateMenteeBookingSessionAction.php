<?php

namespace App\Actions\Booking;

use App\Enums\MenteeBookingSessionStatus;
use App\Models\MenteeBookingSession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateMenteeBookingSessionAction
{
    public function handle(User $mentor): string
    {
        $mentee = Auth::user();

        $mentee->menteeBookingSessions()
            ->Where('mentor_id', $mentor->id)
            ->where('status', MenteeBookingSessionStatus::PENDING)
            ->update(['status' => MenteeBookingSessionStatus::FAILED]);

        $mentorHourlyRate = $mentor->mentorProfile->hourly_rate;

        /** @var MenteeBookingSession $menteeBookingSession */
        $menteeBookingSession = $mentee->menteeBookingSessions()->create([
            'mentor_id' => $mentor->id,
            'price' => $mentorHourlyRate,
            'expires_at' => now()->addMinutes(120), // @todo: change when going to production
        ]);

        return $menteeBookingSession->uuid;
    }
}
