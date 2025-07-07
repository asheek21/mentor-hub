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

        return [];

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
}
