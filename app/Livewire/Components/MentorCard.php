<?php

namespace App\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class MentorCard extends Component
{
    public User $mentor;

    public function render()
    {
        $userRating = $this->mentor->averageRating();

        $userRatingRounded = round($userRating);

        $skills = $this->mentor->mentorSkills();

        $hourlyRate = $this->mentor->mentorProfile->hourly_rate;

        $hourlyRate = rupeeFormatter($hourlyRate);

        return view('livewire.components.mentor-card', compact(
            'userRating',
            'userRatingRounded',
            'skills',
            'hourlyRate'
        ));
    }

    public function goToMentorProfilePage()
    {
        return Redirect::route('mentor.profile', [$this->mentor]);
    }
}
