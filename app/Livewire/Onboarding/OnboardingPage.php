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

    public array $weekDays = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
    ];

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

        $this->totalStep = $this->user->user_role == UserRole::MENTOR ? 4 : 3;

        return view('livewire.onboarding.onboarding-page');
    }

    #[On('profile-updated')]
    public function profileUpdated($data)
    {
        $completedStep = $data['completedStep'];

        if ($completedStep == 1) {
            $this->user->onboarding_stage = OnboardingStage::SECOND_STEP;
            $this->user->save();

            $this->currentStep = $this->user->onboarding_stage->step();

        } elseif ($completedStep == 2) {

            $this->user->onboarding_stage = OnboardingStage::THIRD_STEP;
            $this->user->save();

            $this->currentStep = $this->user->onboarding_stage->step();

        } elseif ($completedStep == 3) {

            if ($this->user->user_role == UserRole::MENTOR) {
                $this->user->onboarding_stage = OnboardingStage::FOURTH_STEP;
                $this->user->save();

                $this->currentStep = $this->user->onboarding_stage->step();
            }

            if ($this->user->user_role == UserRole::MENTEE) {

                $this->user->onboarding_stage = OnboardingStage::COMPLETED;
                $this->user->save();

                $this->currentStep = $this->user->onboarding_stage->step();

                $this->dashboardRedirect();
            }

        } elseif ($completedStep == 4) {

            if ($this->user->user_role == UserRole::MENTOR) {
                $this->user->onboarding_stage = OnboardingStage::COMPLETED;
                $this->user->save();

                $this->currentStep = $this->user->onboarding_stage->step();

                $this->dashboardRedirect();
            }
        }
    }

    public function dashboardRedirect()
    {
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
