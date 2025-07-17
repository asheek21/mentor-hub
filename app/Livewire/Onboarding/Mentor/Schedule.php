<?php

namespace App\Livewire\Onboarding\Mentor;

use App\Enums\AdvanceBookingWindow;
use App\Enums\MaximumBookingWindow;
use App\Livewire\Onboarding\OnboardingPage;
use App\Livewire\Onboarding\SchedulePreview;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Schedule extends Component
{
    public User $user;

    public array $weekDays;

    public array $schedule = [];

    public string $timezone = 'Asia/Kolkata';

    public string $advance_booking_window = AdvanceBookingWindow::SAMEDAY->value;

    public string $maximum_booking_window = MaximumBookingWindow::ONEWEEK->value;

    public int $daily_session_limit = 0;

    public bool $send_notification = false;

    public array $enabledDays = [];

    public function mount()
    {
        foreach ($this->weekDays as $day) {
            $this->schedule[$day] = [
                'from' => '9:00 AM',
                'to' => '5:00 PM',
            ];
        }
    }

    public function render()
    {
        $advanceBookingWindows = AdvanceBookingWindow::cases();
        $maximumBookingWindows = MaximumBookingWindow::cases();
        $indiaTimeNow = Carbon::now('Asia/Kolkata')->format('h:i A');

        return view('livewire.onboarding.mentor.schedule', compact(
            'advanceBookingWindows', 'maximumBookingWindows', 'indiaTimeNow'
        ));
    }

    public function toggleDay($weekDay): void
    {
        if (in_array($weekDay, $this->enabledDays)) {
            $this->enabledDays = array_diff($this->enabledDays, [$weekDay]);
        } else {
            $this->enabledDays[] = $weekDay;
        }

        $this->updateDataToPreview();
    }

    public function saveSchedule()
    {
        $this->validate($this->rules());

        foreach ($this->schedule as $day => $time) {
            if (in_array($day, $this->enabledDays)) {
                $this->schedule[$day]['enabled'] = in_array($day, $this->enabledDays);
            }
        }

        $this->user->mentorSchedule()->create([
            'schedule' => $this->schedule,
            'timezone' => $this->timezone,
            'advance_booking_window' => $this->advance_booking_window,
            'maximum_booking_window' => $this->maximum_booking_window,
            'daily_session_limit' => $this->daily_session_limit,
            'buffer_time' => 0,
            'automatically_mark_slot' => true,
            'send_notification' => $this->send_notification,
        ]);

        Toaster::success('Schedule updated!');

        $this->dispatch('formSubmitted');

        $this->dispatch('profile-updated', [
            'completedStep' => 3,
        ])->to(OnboardingPage::class);
    }

    protected function rules(): array
    {
        return [
            'schedule' => 'required|array',
            'schedule.*.from' => 'required',
            'schedule.*.to' => 'required',
            'advance_booking_window' => ['required', Rule::enum(AdvanceBookingWindow::class)],
            'maximum_booking_window' => ['required', Rule::enum(MaximumBookingWindow::class)],
            'daily_session_limit' => 'required|numeric|digits_between:0,5',
            'send_notification' => 'required|boolean',
        ];
    }

    public function scheduleChanged($weekDay, $direction, $time)
    {
        $this->schedule[$weekDay][$direction] = $time;

        $this->updateDataToPreview();
    }

    private function updateDataToPreview()
    {
        foreach ($this->schedule as $day => $time) {
            if (in_array($day, $this->enabledDays)) {
                $this->schedule[$day]['enabled'] = true;
            }
        }

        $this->dispatch('update-preview', $this->schedule)->to(SchedulePreview::class);
    }
}
