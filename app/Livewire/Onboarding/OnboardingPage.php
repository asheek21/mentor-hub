<?php

namespace App\Livewire\Onboarding;

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class OnboardingPage extends Component
{
    public int $currentStep = 1;

    public int $totalStep;

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->onboarding_stage == OnboardingStage::COMPLETED) {
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }
    }

    public function render()
    {
        $this->currentStep = $this->user->onboarding_stage->step();

        $this->totalStep = $this->user->user_role == UserRole::MENTOR ? 2 : 1;

        $isMentee = $this->user->user_role == UserRole::MENTEE;

        return view('livewire.onboarding.onboarding-page', compact('isMentee'));
    }

    #[On('profile-updated')]
    public function profileUpdated($data)
    {
        $completedStep = $data['completedStep'];

        if ($this->user->user_role == UserRole::MENTOR) {

            if ($completedStep == 1) {
                $this->user->onboarding_stage = OnboardingStage::SECOND_STEP;
                $this->user->save();

                $this->currentStep = $this->user->onboarding_stage->step();

            } elseif ($completedStep == 2) {

                $this->user->onboarding_stage = OnboardingStage::COMPLETED;
                $this->user->save();
                $this->redirect(route('dashboard', absolute: false), navigate: true);
            }

        } else {

            $this->user->onboarding_stage = OnboardingStage::COMPLETED;
            $this->user->save();
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }

    }
}
