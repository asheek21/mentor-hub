<?php

namespace App\Livewire\Onboarding\Mentor;

use App\Actions\UpdateMentorPricingAction;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Pricing extends Component
{
    public ?float $hourly_rate = null;

    public int $session_duration = 60;

    public User $user;

    public function render()
    {
        return view('livewire.onboarding.mentor.pricing');
    }

    public function previewUpdates()
    {
        $hourlyRate = $this->hourly_rate;
        $sessionDuration = $this->session_duration;

        $this->dispatch('onboarding-step1-updated', [
            'hourlyRate' => $hourlyRate,
            'sessionDuration' => $sessionDuration,
        ]);
    }

    public function updatePricing()
    {
        $this->validate([
            'hourly_rate' => ['required', 'numeric'],
            'session_duration' => ['required', 'numeric'],
        ]);

        app(UpdateMentorPricingAction::class)->execute($this->user, [
            'hourly_rate' => $this->hourly_rate,
            'session_duration' => $this->session_duration,
        ]);

        Toaster::success('profile updated! Welcome to the community!');

        $this->dispatch('profile-updated', [
            'completedStep' => 4,
        ])->to(OnboardingPage::class);
    }
}
