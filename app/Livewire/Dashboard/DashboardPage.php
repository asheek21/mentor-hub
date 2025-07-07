<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Components\BaseComponent;
use App\Services\StatService;

class DashboardPage extends BaseComponent
{
    public function render()
    {
        $stats = $this->stats();
        // dd($stats);

        $bannerMessage = $this->getBannerMessage();

        return view('livewire.dashboard.dashboard-page', compact(
            'bannerMessage',
            'stats'
        ));
    }

    /**
     * Return a string message that will be displayed as a banner message on the dashboard
     */
    public function getBannerMessage(): string
    {
        // If the user is a mentor, show the number of upcoming sessions today and the number of new course enrollments
        if ($this->user->isMentor()) {
            return 'You have 0 upcoming sessions today and 0 new course enrollments';
        }

        // If the user is a mentee, show the number of upcoming sessions this week and the number of courses in progress

        return 'You have 2 upcoming sessions this week and 3 courses in progress';
    }

    public function stats()
    {
        return app(StatService::class)->stats();
    }
}
