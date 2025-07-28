<?php

namespace App\Livewire\Booking;

use App\Models\MenteeBookingSession;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Header extends Component
{
    public MenteeBookingSession $menteeBookingSession;

    public function render()
    {
        $now = Carbon::now();

        $expiresAt = $this->menteeBookingSession->expires_at;

        /** @phpstan-ignore-next-line */
        $timeLeftSeconds = round($now->floatDiffInSeconds($expiresAt));

        return view('livewire.booking.header', compact('timeLeftSeconds'));
    }
}
