<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class Experience extends Component
{
    public User $user;

    public function render()
    {
        $experiences = $this->user->mentorProfile->work_experience
            ->map(function ($experience, $key) {
                $experience['limited_description'] = substr($experience['description'], 0, 100);

                return $experience;
            });

        return view('livewire.mentor-profile.experience', compact('experiences'));
    }
}
