<?php

namespace App\Livewire\Session;

use App\Services\SessionStats;
use Livewire\Component;

class SessionPage extends Component
{
    public function render()
    {
        $stats = $this->stats();

        return view('livewire.session.session-page', [
            'stats' => $stats,
        ]);
    }

    public function stats()
    {
        return app(SessionStats::class)->stats();
    }
}
