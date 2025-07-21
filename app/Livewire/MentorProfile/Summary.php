<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class Summary extends Component
{
    public User $user;

    public function render()
    {
        $mentorProfile = $this->user->mentorProfile;

        // dd($mentorProfile);
        return view('livewire.mentor-profile.summary');
    }
}
