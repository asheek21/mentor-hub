<?php

namespace App\Livewire\Mentor;

use Livewire\Component;

class Sort extends Component
{
    public string $sort = 'recommended';

    public function render()
    {
        $sorts = [
            [
                'label' => 'Recommended',
                'value' => 'recommended',
            ],
            [
                'label' => 'Highest Rated',
                'value' => 'highest_rated',
            ],
            [
                'label' => 'Price: Low to High',
                'value' => 'price_low_to_high',
            ],
            [
                'label' => 'Price: High to Low',
                'value' => 'price_high_to_low',
            ],

        ];

        return view('livewire.mentor.sort', compact('sorts'));
    }

    public function updatedSort($value)
    {
        $this->sort = $value;

        $this->dispatch('appliedSort', $this->sort)->to(Browse::class);
    }
}
