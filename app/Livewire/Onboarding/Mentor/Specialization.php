<?php

namespace App\Livewire\Onboarding\Mentor;

use App\Actions\UpdateMentorSpecializationAction;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Specialization extends Component
{
    public User $user;

    public array $specialization = [
        'programming' => [],
        'design' => [],
        'career' => [],
        'others' => [],
    ];

    public function render()
    {
        return view('livewire.onboarding.mentor.specialization');
    }

    public function previewUpdates()
    {
        $specilization = $this->specialization;

        $this->dispatch('onboarding-step1-updated', [
            'specilization' => $specilization,
        ]);
    }

    public function updateSpecialization()
    {
        $this->validate([
            'specialization' => 'required|array',
        ]);

        if (
            empty($this->specialization['programming']) &&
            empty($this->specialization['design']) &&
            empty($this->specialization['career']) &&
            empty($this->specialization['others'])
        ) {
            $this->addError('specialization', 'Please select at least one specialization or fill in "Others".');

            return;
        }

        app(UpdateMentorSpecializationAction::class)->execute($this->user, $this->specialization);

        Toaster::success('profile updated!');

        $this->dispatch('formSubmitted');

        $this->dispatch('profile-updated', [
            'completedStep' => 2,
        ])->to(OnboardingPage::class);

    }
}
