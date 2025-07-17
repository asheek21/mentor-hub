<?php

namespace App\Livewire\Onboarding\Mentee;

use App\Actions\UpdateMenteeInterestAction;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Interest extends Component
{
    public User $user;

    #[Validate('required|array')]
    public array $interests = [
        'programming' => [],
        'design' => [],
        'career' => [],
        'others' => [],
    ];

    public function render()
    {
        return view('livewire.onboarding.mentee.interest');
    }

    public function previewUpdates()
    {
        $interests = $this->interests;

        $this->dispatch('onboarding-step1-updated', [
            'specilization' => $interests,
        ]);
    }

    public function updateInterest()
    {
        $this->validate();

        app(UpdateMenteeInterestAction::class)->execute($this->user, $this->interests);

        Toaster::success('profile updated!');

        $this->dispatch('profile-updated', [
            'completedStep' => 2,
        ])->to(OnboardingPage::class);
    }
}
