<?php

namespace App\Livewire\Booking;

use App\Models\MentorSchedule;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public User $mentor;

    public array $months;

    public $mentorConfirmedBookingDates;

    public int $currentMonthIndex = 0;

    public string $selectedDate = '';

    public ?MentorSchedule $mentorSchedule;

    public array $timeSlots = [];

    public string $selectedTimeSlot = '';

    public function mount()
    {
        $this->mentorSchedule = $this->mentor->mentorSchedule;
        $this->mentorConfirmedBookingDates = $this->mentor->mentorUpcomingBookingDates();

        $this->months = $this->getThreeMonths();

        $enabledToday = collect($this->months[$this->currentMonthIndex]['days'])
            ->filter(function ($day) {
                return $day['is_today'] && $day['is_enabled'];
            })->first();

        $this->setSelectedDate($enabledToday);
    }

    public function render()
    {
        return view('livewire.booking.calendar');
    }

    private function getThreeMonths()
    {
        $currentMonth = now()->month;
        $currentYear = date('Y');

        $months = [];

        $totalEnabledDays = 0;

        for ($i = 0; $i < 3; $i++) {

            $days = [];

            $monthNumber = $currentMonth + $i;

            $year = $currentYear;

            if ($monthNumber > 12) {
                $monthNumber -= 12;
                $year++;
            }

            $days = $this->getWeekDates($monthNumber, $year, $totalEnabledDays);

            $months[] = [
                'month' => date('F', mktime(0, 0, 0, $monthNumber, 1, $year)),
                'year' => $year,
                'days' => $days,
            ];
        }

        return $months;
    }

    private function getWeekDates($monthNumber, $year, int &$totalEnabledDays): array
    {
        $daysThisMonth = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $year);

        $days = [];

        for ($day = 1; $day <= $daysThisMonth; $day++) {

            $carbonDate = Carbon::createFromDate($year, $monthNumber, $day, 'Asia/Kolkata');

            $dayName = $carbonDate->format('l');

            $isToday = $carbonDate->isToday();

            $isPast = $isToday ? false : $carbonDate->isPast();

            $isEnabled = $this->checkIfItIsEnabled($day, $dayName, $isPast, $totalEnabledDays);

            $days[] = [
                'date' => $carbonDate->format('Y-m-d'),
                'date_number' => $carbonDate->format('d'),
                'day' => $dayName,
                'is_today' => $isToday,
                'is_past' => $isPast,
                'is_enabled' => $isEnabled,
            ];
        }

        return $days;
    }

    public function populateTimeSlots(?array $selectedDay)
    {
        $dayName = $selectedDay['day'] ?? null;

        if (! $dayName) {
            return;
        }

        $daySchedule = $this->mentorSchedule?->schedule[$dayName] ?? null;
        // dd($daySchedule) ;
        $mentorSessionDuration = $this->mentor->mentorProfile->session_duration;

        if ($daySchedule && $daySchedule['enabled']) {

            $selectedDate = Carbon::parse($selectedDay['date'], 'Asia/Kolkata');

            $startTime = $selectedDate->copy()->setTimeFromTimeString($daySchedule['from']);
            $endTime = $selectedDate->copy()->setTimeFromTimeString($daySchedule['to']);

            $now = Carbon::now('Asia/Kolkata');

            // If selected day is today, and start time is in the past, skip past slots
            if ($selectedDay['is_today']) {
                $startTime = $startTime->greaterThan($now) ? $startTime : $now->copy()->ceilMinutes($mentorSessionDuration);
            }

            $timeSlots = [];
            $i = 0;

            while ($startTime->addMinutes(0)->lessThan($endTime)) {
                $slotEnd = $startTime->copy()->addMinutes($mentorSessionDuration);

                if ($slotEnd->greaterThan($endTime)) {
                    break;
                }

                $timeSlots[$i]['slot_start_time'] = $startTime->format('h:i A');

                if ($this->mentorConfirmedBookingDates->contains(function ($date) use ($startTime) {
                    return $date->format('Y-m-d H:i:s') == $startTime->format('Y-m-d H:i:s');
                })) {
                    $timeSlots[$i]['is_booked'] = true;
                } else {
                    $timeSlots[$i]['is_booked'] = false;
                }

                $startTime->addMinutes($mentorSessionDuration);
                $i++;
            }

            $this->timeSlots = $timeSlots;
        }
    }

    public function action($type)
    {
        if ($type == 'previousMonth') {
            $this->currentMonthIndex == 0 ? 0 : $this->currentMonthIndex--;
        }

        if ($type == 'nextMonth') {
            $this->currentMonthIndex == 2 ? 2 : $this->currentMonthIndex++;
        }
    }

    private function setSelectedDate(?array $selectedDay)
    {
        if (! empty($selectedDay) && $selectedDay['is_enabled'] && ! $selectedDay['is_past']) {
            $this->selectedDate = $selectedDay['date'];

            $this->populateTimeSlots($selectedDay);
        }
    }

    public function updateSelectedDate(int $key)
    {
        $selectedDay = $this->months[$this->currentMonthIndex]['days'][$key];

        $this->setSelectedDate($selectedDay);
    }

    private function checkIfItIsEnabled(int $day, string $dayName, bool $isPast, int &$totalEnabledDays): bool
    {
        $mentorSchedules = $this->mentorSchedule?->schedule;

        $maximumBookingWindow = $this->mentorSchedule?->maximum_booking_window->day();

        if ($isPast) {
            return false;
        }

        $enabled = $mentorSchedules[$dayName]['enabled'] ?? false;

        if (! $enabled) {
            return false;
        }

        if ($totalEnabledDays >= $maximumBookingWindow) {
            return false;
        }

        $totalEnabledDays++;

        return true;
    }

    public function setSelectedTimeSlot($key)
    {
        if ($this->timeSlots[$key]['is_booked']) {
            return;
        }

        $selectedTimeSlot = $this->timeSlots[$key]['slot_start_time'] ?? '';

        $this->selectedTimeSlot = $selectedTimeSlot != $this->selectedTimeSlot ? $selectedTimeSlot : '';

        $this->dispatch('selected-time-date', [
            'time' => $this->selectedTimeSlot,
            'date' => $this->selectedDate,
        ]);
    }
}
