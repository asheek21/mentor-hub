<?php

namespace App\Livewire\MentorProfile;

use App\Models\MentorSchedule;
use App\Models\User;
use Livewire\Component;

class Availability extends Component
{
    public User $mentor;

    public ?MentorSchedule $mentorSchedules;

    public function mount()
    {
        $this->mentorSchedules = $this->mentor->mentorSchedule;
    }

    public function render()
    {
        $schedules = $this->mentorSchedules?->schedule;

        return view('livewire.mentor-profile.availability', [
            'schedules' => $schedules,
        ]);
    }
}
