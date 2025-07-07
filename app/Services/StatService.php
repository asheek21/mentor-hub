<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class StatService
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
        if ($this->user->isMentor()) {
            return [
                [
                    'label' => "This Month's Earnings",
                    'icon' => 'fas fa-dollar-sign',
                    'iconColor' => 'text-green-600 text-xl',
                    'stat' => $this->getTotalEarnings(),
                ],
                [
                    'label' => 'Total Sessions',
                    'icon' => 'fas fa-video',
                    'iconColor' => 'text-blue-600 text-xl',
                    'stat' => $this->getMentorTotalSession(),
                ],
                [
                    'label' => 'Total Mentees',
                    'icon' => 'fas fa-users',
                    'iconColor' => 'text-purple-600 text-xl',
                    'stat' => $this->getTotalMentees(),
                ],
                [
                    'label' => 'Average Rating',
                    'icon' => 'fas fa-star',
                    'iconColor' => 'text-yellow-600 text-xl',
                    'stat' => $this->user->averageRating(),
                ],
            ];
        }

        return [
            [
                'label' => 'Sessions Completed',
                'icon' => 'fas fa-check-circle',
                'iconColor' => 'text-green-600 text-xl',
                'stat' => $this->getMenteeTotalSession(),
            ],
            [
                'label' => 'Hours Mentored',
                'icon' => 'fas fa-clock',
                'iconColor' => 'text-blue-600 text-xl',
                'stat' => $this->getHoursMentored(),
            ],
            [
                'label' => 'Courses Enrolled',
                'icon' => 'fas fa-book',
                'iconColor' => 'text-purple-600 text-xl',
                'stat' => $this->getMenteeCoursesEnrolled(),
            ],
            [
                'label' => 'Active Mentors',
                'icon' => 'fas fa-users',
                'iconColor' => 'text-yellow-600 text-xl',
                'stat' => $this->getActiveMentors(),
            ],
        ];

    }

    public function getTotalEarnings(): string
    {
        $revenue = new Money(0, new Currency('INR'));

        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en_IN', NumberFormatter::CURRENCY),
            new ISOCurrencies
        );

        return $formatter->format($revenue);
    }

    public function getMentorTotalSession(): int
    {
        return 0;
    }

    public function getTotalMentees(): int
    {
        return 0;
    }

    /**
     * Returns the total number of sessions a mentee has.
     */
    public function getMenteeTotalSession(): int
    {
        return 0;
    }

    public function getHoursMentored(): int
    {
        return 0;
    }

    public function getMenteeCoursesEnrolled(): int
    {
        return 0;
    }

    public function getActiveMentors(): int
    {
        return 0;
    }
}
