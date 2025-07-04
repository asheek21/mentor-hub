<?php

namespace App\Livewire\Onboarding\Mentee;

use App\Enums\LearningPreference;
use App\Enums\MenteeTimeline;
use App\Enums\SessionFrequency;
use App\Livewire\Forms\Onboarding\MenteeStep1Form;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Step1 extends Component
{
    public User $user;

    public MenteeStep1Form $form;

    public function render()
    {
        $learningPreferences = LearningPreference::cases();

        $SessionFrequencies = SessionFrequency::cases();

        $MenteeTimelines = MenteeTimeline::cases();

        return view('livewire.onboarding.mentee.step1', compact(
            'learningPreferences', 'SessionFrequencies', 'MenteeTimelines'
        ));
    }

    public function previewUpdates()
    {
        $currentRole = $this->form->current_role;
        $specilization = $this->form->specialization;

        $this->dispatch('onboarding-step1-updated', [
            'currentRole' => $currentRole,
            'specilization' => $specilization,
            'learning_preference' => LearningPreference::from($this->form->learning_preference)->label(),
            'session_frequency' => SessionFrequency::from($this->form->session_frequency)->label(),
            'timeline' => MenteeTimeline::from($this->form->timeline)->label(),
        ]);
    }

    public function storeProfileDetails()
    {
        $this->form->store();

        Toaster::success('profile updated!');

        $this->dispatch('profile-updated', [
            'completedStep' => 1,
        ])->to(OnboardingPage::class);
    }
}
