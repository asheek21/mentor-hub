<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class MentorProfilePage extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $user->load('mentorProfile')->loadCount('userRatings');

        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.mentor-profile.mentor-profile-page');
    }
}
