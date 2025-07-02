<?php

use App\Livewire\Onboarding\Step2;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Step2::class)
        ->assertStatus(200);
});
