<?php

use App\Livewire\Components\Banner;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Banner::class)
        ->assertStatus(200);
});
