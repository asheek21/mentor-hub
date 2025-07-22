<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Livewire\Component;

class MentorProfilePage extends Component
{
    // route parameter
    public User $mentor;

    public function mount(User $mentor)
    {
        $mentor->load('mentorProfile')->loadCount('userRatings');

        $this->mentor = $mentor;
    }

    public function render()
    {
        return view('livewire.mentor-profile.mentor-profile-page');
    }
}
