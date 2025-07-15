<?php

use App\Livewire\Component\MentorCard;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(MentorCard::class)
        ->assertStatus(200);
});
