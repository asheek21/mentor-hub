<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Banner extends Component
{
    public string $title;

    public string $message;

    public function render()
    {
        return view('livewire.components.banner');
    }
}
