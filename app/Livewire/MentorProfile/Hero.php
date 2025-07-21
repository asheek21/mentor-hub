<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class Hero extends Component
{
    public User $user;

    public function render()
    {
        $mentorSkills = $this->user->mentorSkills();

        $averageRating = $this->user->averageRating();

        $roundedAverageRating = round($averageRating);

        return view('livewire.mentor-profile.hero', compact(
            'mentorSkills',
            'averageRating',
            'roundedAverageRating'
        ));
    }
}
