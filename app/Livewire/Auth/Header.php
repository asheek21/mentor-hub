<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public array $menu = [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
            'coming_soon' => 'false',
            'active' => true,
        ],
    ];

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->isMentor()) {
            array_push($this->menu,
                [
                    'name' => 'Sessions',
                    'route' => 'sessions',
                    'coming_soon' => 'false',
                    'active' => false,
                ],
                [
                    'name' => 'Courses',
                    'route' => 'courses',
                    'coming_soon' => 'false',
                    'active' => false,
                ],
                [
                    'name' => 'Messages',
                    'route' => 'messages',
                    'coming_soon' => 'false',
                    'active' => false,
                ]
            );
        }

        array_push($this->menu,
            [
                'name' => 'Browse Mentors',
                'route' => 'browse-mentors',
                'coming_soon' => 'false',
                'active' => false,
            ],
            [
                'name' => 'My Sessions',
                'route' => 'sessions',
                'coming_soon' => 'false',
                'active' => false,
            ],
            [
                'name' => 'Courses',
                'route' => 'courses',
                'coming_soon' => 'false',
                'active' => false,
            ],
            [
                'name' => 'Messages',
                'route' => 'messages',
                'coming_soon' => 'false',
                'active' => false,
            ]
        );
    }

    public function render()
    {
        return view('livewire.auth.header');
    }
}
