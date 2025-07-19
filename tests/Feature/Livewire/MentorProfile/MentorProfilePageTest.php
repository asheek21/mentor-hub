<?php

use App\Livewire\MentorProfile\MentorProfilePage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(MentorProfilePage::class)
        ->assertStatus(200);
});
