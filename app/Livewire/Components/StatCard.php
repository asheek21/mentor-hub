<?php

namespace App\Livewire\Components;

use Livewire\Component;

class StatCard extends Component
{
    public string $label;

    public string $stat;

    public string $icon;

    public string $iconColor;

    public function render()
    {
        return view('livewire.components.stat-card');
    }
}
