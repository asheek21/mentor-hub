<?php

namespace App\Livewire\Session;

use App\Services\SessionStats;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class SessionPage extends Component
{
    #[Url]
    public string $tab = '';

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

    #[On('tabUpdated')]
    public function tabUpdated($tab)
    {
        $this->tab = $tab;
    }
}
