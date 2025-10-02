<?php

namespace App\Livewire\Booking;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Summary extends Component
{
    public string $selectedDate = '';

    public string $selectedTimeSlot = '';

    public User $mentor;

    public function render()
    {
        $mentorProfile = $this->mentor->mentorProfile;

        $sessionDuration = $mentorProfile->session_duration;

        $hourlyRate = $mentorProfile->hourly_rate;

        return view('livewire.booking.summary', compact(
            'sessionDuration',
            'hourlyRate'
        ));
    }

    #[On('selected-time-date')]
    public function selectedTimeAndDate(array $slot)
    {
        $this->selectedDate = $slot['date'];

        $this->selectedTimeSlot = $slot['time'];
    }
}
