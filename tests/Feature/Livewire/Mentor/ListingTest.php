<?php

use App\Livewire\Mentor\Listing;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Listing::class)
        ->assertStatus(200);
});
