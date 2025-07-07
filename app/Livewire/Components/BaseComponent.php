<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

abstract class BaseComponent extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    // You can also add a helper method
    protected function getUser()
    {
        return $this->user ?? Auth::user();
    }
}
