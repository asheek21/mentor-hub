<?php

namespace App\Livewire\Onboarding;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class SchedulePreview extends Component
{
    public User $user;

    public array $weekDays;

    public array $schedule = [];

    public function render()
    {
        return view('livewire.onboarding.schedule-preview');
    }

    #[On('update-preview')]
    public function updateWeekPreview($schedule)
    {
        $this->schedule = $schedule;
    }
}
