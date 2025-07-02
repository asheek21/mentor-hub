<?php

namespace App\Livewire\Onboarding;

use App\Enums\YearsOfExperience;
use App\Livewire\Forms\Onboarding\Step1Form;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class Step1 extends Component
{
    use WithFileUploads;

    public User $user;

    public $profilePicture = null;

    public Step1Form $form;

    public function render()
    {
        $this->profilePicture = $this->user->getFirstMediaUrl(User::MEDIA_LIBRARY_PROFILE);

        $name = $this->user->first_name.' '.$this->user->last_name;

        $experienceLevels = YearsOfExperience::cases();

        return view('livewire.onboarding.step1', compact('name', 'experienceLevels'));
    }

    public function updatedProfilePicture()
    {
        $this->validate([
            'profilePicture' => 'image|max:2048',
        ]);

        $this->user->clearMediaCollection(User::MEDIA_LIBRARY_PROFILE);

        $this->user->addMedia($this->profilePicture)->toMediaCollection(User::MEDIA_LIBRARY_PROFILE);

        Toaster::success('Profile picture updated!');
    }

    public function storeProfileDetails()
    {
        $this->form->store();

        Toaster::success('Mentor profile updated!');

        $this->dispatch('profile-updated', [
            'completedStep' => 1,
        ])->to(OnboardingPage::class);
    }

    public function previewUpdates()
    {
        $currentRole = $this->form->current_role;
        $specilization = $this->form->specialization;
        $hourlyRate = $this->form->hourly_rate;
        $sessionDuration = $this->form->session_duration;

        $this->dispatch('onboarding-step1-updated', [
            'currentRole' => $currentRole,
            'specilization' => $specilization,
            'hourlyRate' => $hourlyRate,
            'sessionDuration' => $sessionDuration,
        ]);
    }
}
