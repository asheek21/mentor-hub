<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;

class Header extends Component
{
    public int $currentStep;

    public int $totalStep;

    public function render()
    {
        $completedStep = $this->currentStep - 1;

        $percentageCompleted = ($completedStep / $this->totalStep) * 100;

        return view('livewire.onboarding.header', compact('percentageCompleted'));
    }
}
