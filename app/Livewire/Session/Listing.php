<?php

namespace App\Livewire\Session;

use App\Actions\Sessions\ListMenteeSessionDetailsAction;
use App\Livewire\Components\BaseComponent;
use Livewire\Attributes\Reactive;

class Listing extends BaseComponent
{
    #[Reactive]
    public string $tab = '';

    public function render()
    {
        $sessions = $this->getSessionDetails();

        return view('livewire.session.listing', compact('sessions'));
    }

    public function getSessionDetails()
    {
        return app(ListMenteeSessionDetailsAction::class)->execute($this->user, $this->tab);
    }
}
