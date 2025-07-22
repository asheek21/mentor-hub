<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class Experience extends Component
{
    public User $mentor;

    public function render()
    {
        $experiences = $this->mentor->mentorProfile->work_experience
            ->map(function ($experience, $key) {
                $experience['limited_description'] = substr($experience['description'], 0, 100);

                return $experience;
            });

        return view('livewire.mentor-profile.experience', compact('experiences'));
    }
}
