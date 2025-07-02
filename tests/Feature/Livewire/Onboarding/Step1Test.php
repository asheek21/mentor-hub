<?php

use App\Livewire\Onboarding\Step1;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Step1::class)
        ->assertStatus(200);
});
