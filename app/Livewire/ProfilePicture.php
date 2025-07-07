<?php

namespace App\Livewire;

use App\Livewire\Onboarding\Preview;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Masmerise\Toaster\Toaster;

class ProfilePicture extends Component
{
    use WithFileUploads;

    public User $user;

    public $profilePicture = null;

    public function render()
    {
        $this->profilePicture = $this->user->getFirstMediaUrl(User::MEDIA_LIBRARY_PROFILE);

        $name = $this->user->first_name.' '.$this->user->last_name;

        return view('livewire.profile-picture', compact('name'));
    }

    public function updatedProfilePicture()
    {
        $this->validate([
            'profilePicture' => 'image|max:2048',
        ]);

        $this->user->clearMediaCollection(User::MEDIA_LIBRARY_PROFILE);

        $this->user->addMedia($this->profilePicture)->toMediaCollection(User::MEDIA_LIBRARY_PROFILE);

        Toaster::success('Profile picture updated!');

        $this->dispatch('profile-picture-updated')->to(Preview::class);
    }
}
