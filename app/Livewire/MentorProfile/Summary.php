<?php

namespace App\Livewire\MentorProfile;

use App\Actions\Booking\CreateMenteeBookingSessionAction;
use App\Models\User;
use Livewire\Component;

class Summary extends Component
{
    public User $mentor;

    public function render()
    {
        return view('livewire.mentor-profile.summary');
    }

    public function bookSession()
    {
        $menteeBookingSessionUuid = app(CreateMenteeBookingSessionAction::class)->handle($this->mentor);

        $this->dispatch('redirect-to-booking', $menteeBookingSessionUuid)->to(MentorProfilePage::class);
    }
}
