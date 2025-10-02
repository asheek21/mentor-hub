<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class Hero extends Component
{
    public User $mentor;

    public function render()
    {
        $mentorSkills = $this->mentor->mentorSkills();

        $averageRating = $this->mentor->averageRating();

        $roundedAverageRating = round($averageRating);

        return view('livewire.mentor-profile.hero', compact(
            'mentorSkills',
            'averageRating',
            'roundedAverageRating'
        ));
    }
}
