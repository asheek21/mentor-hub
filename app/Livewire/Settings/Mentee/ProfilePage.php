<?php

namespace App\Livewire\Settings\Mentee;

use App\Livewire\Components\BaseComponent;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ProfilePage extends BaseComponent
{
    #[Url()]
    public string $tab;

    public function render()
    {
        return view('livewire.settings.mentee.profile-page');
    }

    #[On('updateTabQuery')]
    public function changeTab(string $tab)
    {
        $this->tab = $tab;
    }
}
