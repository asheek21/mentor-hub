<?php

namespace App\Livewire\Onboarding\Mentor;

use App\Livewire\Forms\ProfessionalDetailForm;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PersonalInformation extends Component
{
    public User $user;

    public ProfessionalDetailForm $form;

    public function mount()
    {
        $this->form->setInitialState();
    }

    public function addExperience()
    {
        $this->form->experiences[] = [
            'job_title' => '',
            'company_name' => '',
            'start_date' => '',
            'end_date' => '',
            'current_position' => false,
            'description' => '',
        ];
    }

    public function removeExperience($index)
    {
        if ($index < 0 || $index >= count($this->form->experiences)) {
            return;
        }

        unset($this->form->experiences[$index]);
        $this->form->experiences = array_values($this->form->experiences);
    }

    public function render()
    {
        return view('livewire.onboarding.mentor.personal-information');
    }

    public function previewUpdates()
    {
        $currentRole = $this->form->current_role;

        $this->dispatch('onboarding-step1-updated', [
            'currentRole' => $currentRole,
        ]);
    }

    public function storeProfessionalDetails()
    {
        $this->form->store($this->user);

        Toaster::success('Mentor profile updated!');

        $this->dispatch('profile-updated', [
            'completedStep' => 1,
        ])->to(OnboardingPage::class);
    }
}
