<?php

use App\Livewire\Mentor\Browse;
use App\Livewire\Mentor\Filter;
use Livewire\Livewire;

test('can dispatch filter event to parent component', function () {
    Livewire::test(Filter::class)
        ->set('filters.search', 'test')
        ->set('filters.skill', 'javascript')
        ->assertDispatchedTo(
            Browse::class,
            'appliedFilters',
            ['search' => 'test', 'skill' => 'javascript', 'price' => '']
        );
});
