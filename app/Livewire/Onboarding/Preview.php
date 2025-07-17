<?php

namespace App\Livewire\Onboarding;

use App\Enums\LearningPreference;
use App\Enums\OnboardingStage;
use App\Enums\SessionFrequency;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Preview extends Component
{
    public User $user;

    public ?string $currentRole = '';

    public ?array $specialization = [];

    public ?float $hourlyRate = null;

    public int $sessionDuration = 60;

    public ?string $learning_preference = '';

    public ?string $session_frequency = '';

    public function mount()
    {
        $this->currentRole = $this->getCurrentRole();

        $specialization = $this->getSpecialization();

        $this->specialization = $this->setSpecialization($specialization);

        $this->learning_preference = $this->getLearningPreference();

        $this->session_frequency = $this->getSessionFrequency();
    }

    public function render()
    {
        $profilePicture = $this->user->profile_picture;

        return view('livewire.onboarding.preview', [
            'profilePicture' => $profilePicture,
        ]);
    }

    #[On('onboarding-step1-updated')]
    public function step1Datas($datas)
    {
        $this->currentRole = $datas['currentRole'] ?? $this->currentRole;

        $specialization = $datas['specilization'] ?? [];

        $this->specialization = $this->setSpecialization($specialization);

        $this->hourlyRate = $datas['hourlyRate'] ?? 0;

        $this->sessionDuration = $datas['sessionDuration'] ?? 0;

        $this->learning_preference = $datas['learning_preference'] ?? '';

        $this->session_frequency = $datas['session_frequency'] ?? '';
    }

    #[On('profile-picture-updated')]
    public function profilePictureUpdated()
    {
        $this->user->refresh();
    }

    public function setSpecialization(array $specialization = []): array
    {
        if (empty($specialization)) {
            return $this->specialization;
        }

        $flat = collect($specialization)
            ->flatMap(function ($item) {
                if (is_array($item)) {
                    return $item;
                }

                return [$item];
            })
            ->filter()
            ->values()
            ->take(2);

        return $flat->all();
    }

    public function getCurrentRole()
    {
        if ($this->user->isMentor()) {
            return $this->user->mentorProfile?->current_role;
        }

        return $this->user->menteeProfile?->current_role;
    }

    public function getSpecialization(): array
    {
        if ($this->user->isMentor()) {
            return $this->user->mentorProfile?->specialization?->toArray() ?? [];
        }

        return $this->user->menteeProfile?->interests?->toArray() ?? [];
    }

    public function getLearningPreference()
    {
        $learningPreference = $this->user->menteeProfile?->learning_preference;

        if ($learningPreference) {
            return $learningPreference->label();
        }

        if ($this->user->onboarding_stage == OnboardingStage::THIRD_STEP) {
            return LearningPreference::HANDSONPRACTICE->label();
        }

        return '';
    }

    public function getSessionFrequency()
    {
        $sessionFrequency = $this->user->menteeProfile?->session_frequency;

        if ($sessionFrequency) {
            return $sessionFrequency->label();
        }

        if ($this->user->onboarding_stage == OnboardingStage::THIRD_STEP) {
            return SessionFrequency::WEEKLYSESSION->label();
        }

        return '';
    }
}
