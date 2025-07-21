<?php

namespace App\Livewire\MentorProfile;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Reviews extends Component
{
    public User $user;

    public Collection $reviews;

    public function mount()
    {
        $this->reviews = $this->user->userRatings()
            ->whereNotNull('comment')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.mentor-profile.reviews');
    }
}
