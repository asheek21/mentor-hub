<?php

namespace App\Livewire\Settings;

use App\Livewire\Settings\Mentee\ProfilePage;
use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public User $user;

    public string $tab;

    public function render()
    {
        $sideBarMenus = $this->getSidebarMenus();

        return view('livewire.settings.sidebar', compact('sideBarMenus'));
    }

    public function getSidebarMenus()
    {
        if ($this->user->isMentee()) {
            return [
                [
                    'title' => 'Personal Information',
                    'tab' => 'personal-information',
                    'icon' => 'fas fa-user mr-3',
                ],
                [
                    'title' => 'Interests',
                    'tab' => 'interests',
                    'icon' => 'fas fa-heart mr-3',
                ],
                [
                    'title' => 'Learning Preference',
                    'tab' => 'learning-preference',
                    'icon' => 'fas fa-cog mr-3',
                ],
                [
                    'title' => 'Appearance',
                    'tab' => 'appearance',
                    'icon' => 'fas fa-cog mr-3',
                ],
            ];
        }

        if ($this->user->isMentor()) {

        }
    }

    public function changeTab(string $tab)
    {
        $this->tab = $tab;
        $this->dispatch('updateTabQuery', $tab)->to(ProfilePage::class);
    }
}
