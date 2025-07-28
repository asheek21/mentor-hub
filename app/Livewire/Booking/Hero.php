<?php

namespace App\Livewire\Booking;

use App\Models\User;
use Livewire\Component;

class Hero extends Component
{
    public User $mentor;

    public function render()
    {
        $averageRating = $this->mentor->averageRating();

        $roundedAverageRating = round($averageRating);

        return view('livewire.booking.hero', compact(
            'averageRating',
            'roundedAverageRating'
        ));
    }
}
