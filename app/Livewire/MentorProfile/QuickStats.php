<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class QuickStats extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.mentor-profile.quick-stats');
    }
}
