<?php

use App\Livewire\Settings\Mentee\ProfilePage;
use Livewire\Livewire;

it('renders successfully', function () {
    mentee();

    Livewire::test(ProfilePage::class, [
        'tab' => 'personal-information',
    ])
        ->assertStatus(200);
});
