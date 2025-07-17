<?php

namespace App\Livewire\Onboarding\Mentee;

use App\Enums\LearningPreference;
use App\Enums\MenteeTimeline;
use App\Enums\SessionFrequency;
use App\Livewire\Forms\Onboarding\MenteePreferenceForm;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Preference extends Component
{
    public User $user;

    public MenteePreferenceForm $form;

    public function render()
    {
        $learningPreferences = LearningPreference::cases();

        $SessionFrequencies = SessionFrequency::cases();

        $MenteeTimelines = MenteeTimeline::cases();

        return view('livewire.onboarding.mentee.preference', compact(
            'learningPreferences', 'SessionFrequencies', 'MenteeTimelines'
        ));
    }

    public function updatePreference()
    {
        $this->form->store($this->user);

        Toaster::success('profile updated!');

        $this->dispatch('profile-updated', [
            'completedStep' => 3,
        ])->to(OnboardingPage::class);
    }

    public function previewUpdates()
    {
        $this->dispatch('onboarding-step1-updated', [
            'learning_preference' => LearningPreference::from($this->form->learning_preference)->label(),
            'session_frequency' => SessionFrequency::from($this->form->session_frequency)->label(),
        ]);
    }
}
