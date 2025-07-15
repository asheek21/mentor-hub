<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;

class MentorCard extends Component
{
    public User $mentor;

    public function render()
    {
        $userRating = $this->mentor->averageRating();

        $userRatingRounded = round($userRating);

        $skills = $this->mentor->mentorSkills();

        $hourlyRate = $this->mentor->userProfile->hourly_rate;

        info($hourlyRate);

        $hourlyRate = rupeeFormatter($hourlyRate);

        return view('livewire.component.mentor-card', compact(
            'userRating',
            'userRatingRounded',
            'skills',
            'hourlyRate'
        ));
    }
}
