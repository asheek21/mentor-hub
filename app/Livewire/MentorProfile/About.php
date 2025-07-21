<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class About extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.mentor-profile.about');
    }
}
