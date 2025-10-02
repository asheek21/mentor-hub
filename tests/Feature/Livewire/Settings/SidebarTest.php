<?php

use App\Livewire\Settings\Sidebar;
use Livewire\Livewire;

it('renders successfully', function () {
    mentee();

    $user = auth()->user();

    Livewire::test(Sidebar::class, [
        'user' => $user,
    ])
        ->assertStatus(200);
});
