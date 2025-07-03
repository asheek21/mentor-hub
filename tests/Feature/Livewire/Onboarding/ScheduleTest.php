<?php

use App\Enums\AdvanceBookingWindow;
use App\Enums\MaximumBookingWindow;
use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Livewire\Onboarding\Schedule;
use App\Models\MentorSchedule;
use App\Models\User;
use Livewire\Livewire;

test('it can create mentor session', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    $weekDays = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
    ];

    $schedule = [];

    foreach ($weekDays as $key => $day) {
        $schedule[$day] = [
            'from' => '9:00 AM',
            'to' => '5:00 PM',
            'enabled' => $key % 2 == 0 ? true : false,
        ];
    }

    $response = Livewire::test(Schedule::class, [
        'user' => $user,
        'weekDays' => $weekDays,
    ])
        ->set('schedule', $schedule)
        ->set('timezone', 'Asia/Kolkata')
        ->set('advance_booking_window', AdvanceBookingWindow::TWENTYFOURHOURS->value)
        ->set('maximum_booking_window', MaximumBookingWindow::TWOWEEKS->value)
        ->set('daily_session_limit', 2)
        ->call('saveSchedule');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->onboarding_stage)->toBe(OnboardingStage::COMPLETED);

    $mentorSchedule = $user->mentorSchedule;

    expect($mentorSchedule)->toBeInstanceOf(MentorSchedule::class);
    expect($mentorSchedule->count())->toBe(1);

    $response->assertRedirect(route('dashboard', absolute: false));
});
