<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Money\Money;

class SessionStats
{
    public User $user;

    // public Money $money;
    public function __construct()
    {
        // $this->money = new Money('')
        $this->user = Auth::user();
    }

    public function stats(): array
    {
        return [
            [
                'label' => 'Upcoming Sessions',
                'icon' => 'fas fa-calendar-check',
                'iconColor' => 'text-blue-600 text-xl',
                'stat' => $this->getUpcomingSessions(),
            ],
            [
                'label' => 'Completed',
                'icon' => 'fas fa-check-circle',
                'iconColor' => 'text-green-600 text-xl',
                'stat' => $this->getCompletedSessions(),
            ],
            [
                'label' => 'Total Hours',
                'icon' => 'fas fa-clock',
                'iconColor' => 'text-purple-600 text-xl',
                'stat' => $this->getTotalCompletedHours(),
            ],
            [
                'label' => 'Avg Rating Given',
                'icon' => 'fas fa-star',
                'iconColor' => 'text-yellow-600 text-xl',
                'stat' => $this->user->averageRating(),
            ],
        ];

    }

    public function getUpcomingSessions(): int
    {
        return Booking::where('mentee_id', $this->user->id)
            ->whereIn('status', [BookingStatus::CONFIRMED, BookingStatus::PENDING])
            ->count();
    }

    public function getCompletedSessions(): int
    {
        return Booking::where('mentee_id', $this->user->id)
            ->where('status', BookingStatus::COMPLETED)
            ->count();
    }

    public function getTotalCompletedHours(): int
    {
        return Booking::where('mentee_id', $this->user->id)
            ->where('status', BookingStatus::COMPLETED)
            ->sum('duration');
    }
}
