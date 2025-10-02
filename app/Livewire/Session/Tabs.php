<?php

namespace App\Livewire\Session;

use Livewire\Component;

class Tabs extends Component
{
    public string $currentTab = '';

    public function mount()
    {
        $this->currentTab = request()->get('tab') ?? '';
    }

    public function render()
    {
        $tabs = $this->getTabs();

        return view('livewire.session.tabs', compact('tabs'));
    }

    private function getTabs(): array
    {
        return [
            [
                'name' => 'All Sessions',
                'query' => 'all-sessions',
            ],
            [
                'name' => 'Upcoming',
                'query' => 'upcoming',
            ],
            [
                'name' => 'Completed',
                'query' => 'completed',
            ],
            [
                'name' => 'Cancelled',
                'query' => 'cancelled',
            ],
        ];
    }

    public function changeTab($tabQuery)
    {
        $this->currentTab = $tabQuery;

        $this->dispatch('tabUpdated', $tabQuery)->to(SessionPage::class);
    }
}
