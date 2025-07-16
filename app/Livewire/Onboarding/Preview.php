<?php

namespace App\Livewire\Onboarding;

use App\Enums\LearningPreference;
use App\Enums\MenteeTimeline;
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

    public string $timeline = '';

    public string $learning_preference = '';

    public string $session_frequency = '';

    public function mount()
    {
        $this->currentRole = $this->user->mentorProfile?->current_role;

        $specialization = $this->user->mentorProfile?->specialization?->toArray() ?? [];

        $this->specialization = $this->setSpecialization($specialization);

        $this->learning_preference = LearningPreference::HANDSONPRACTICE->label();

        $this->session_frequency = SessionFrequency::WEEKLYSESSION->label();

        $this->timeline = MenteeTimeline::ONE_TWO_MONTHS->label();
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

        $this->timeline = $datas['timeline'] ?? '';

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
}
