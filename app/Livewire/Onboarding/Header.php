<?php

namespace App\Livewire\Onboarding;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Header extends Component
{
    #[Reactive]
    public int $currentStep;

    #[Reactive]
    public int $totalStep;

    public function render()
    {
        $completedStep = $this->currentStep - 1;

        $percentageCompleted = round(($completedStep / $this->totalStep) * 100);

        return view('livewire.onboarding.header', compact('percentageCompleted'));
    }
}
