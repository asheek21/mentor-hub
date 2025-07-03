<?php

namespace App\Livewire\Onboarding;

use App\Models\User;
use Livewire\Component;

class Step2 extends Component
{
    public User $user;

    public array $weekDays = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
    ];

    public function render()
    {
        return view('livewire.onboarding.step2');
    }
}
