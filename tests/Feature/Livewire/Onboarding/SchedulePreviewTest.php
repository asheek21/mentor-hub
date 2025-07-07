<?php

use App\Livewire\Onboarding\SchedulePreview;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(SchedulePreview::class)
        ->assertStatus(200);
});
