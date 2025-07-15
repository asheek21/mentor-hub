<?php

use App\Livewire\Mentor\Browse;
use App\Livewire\Mentor\Sort;
use Livewire\Livewire;

test('can dispatch sort event to parent component', function () {
    Livewire::test(Sort::class)
        ->set('sort', 'recommended')
        ->assertDispatchedTo(
            Browse::class,
            'appliedSort',
            'recommended'
        );
});
