<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class Summary extends Component
{
    public User $mentor;

    public function render()
    {
        return view('livewire.mentor-profile.summary');
    }
}
