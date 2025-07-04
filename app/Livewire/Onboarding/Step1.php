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

    public Step1Form $form;

    public function render()
    {
        $name = $this->user->first_name.' '.$this->user->last_name;

        $experienceLevels = YearsOfExperience::cases();

        return view('livewire.onboarding.step1', compact('name', 'experienceLevels'));
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
