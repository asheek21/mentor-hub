<?php

use App\Livewire\Booking\BookingPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(BookingPage::class)
        ->assertStatus(200);
});
