<?php

use App\Enums\AdvanceBookingWindow;
use App\Enums\MaximumBookingWindow;
use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Livewire\Onboarding\Schedule;
use App\Models\MentorSchedule;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->weekDays = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
    ];
});

test('it can create mentor session', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    $schedule = [];

    foreach ($this->weekDays as $key => $day) {
        $schedule[$day] = [
            'from' => '9:00 AM',
            'to' => '5:00 PM',
            'enabled' => $key % 2 == 0 ? true : false,
        ];
    }

    $response = Livewire::test(Schedule::class, [
        'user' => $user,
        'weekDays' => $this->weekDays,
    ])
        ->set('schedule', $schedule)
        ->set('timezone', 'Asia/Kolkata')
        ->set('advance_booking_window', AdvanceBookingWindow::TWENTYFOURHOURS->value)
        ->set('maximum_booking_window', MaximumBookingWindow::TWOWEEKS->value)
        ->set('daily_session_limit', 2)
        ->call('saveSchedule');

    $response->assertHasNoErrors();

    $user->refresh();

    $mentorSchedule = $user->mentorSchedule;

    expect($mentorSchedule)->toBeInstanceOf(MentorSchedule::class);
    expect($mentorSchedule->count())->toBe(1);

    $response->assertDispatched('profile-updated');
});

test('it can save without schedule not set', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Schedule::class, [
        'user' => $user,
        'weekDays' => $this->weekDays,
    ])
        ->set('timezone', 'Asia/Kolkata')
        ->set('advance_booking_window', AdvanceBookingWindow::TWENTYFOURHOURS->value)
        ->set('maximum_booking_window', MaximumBookingWindow::TWOWEEKS->value)
        ->set('daily_session_limit', 2)
        ->call('saveSchedule');

    $response->assertHasNoErrors();

    $user->refresh();

    $mentorSchedule = $user->mentorSchedule;

    expect($mentorSchedule)->toBeInstanceOf(MentorSchedule::class);
    expect($mentorSchedule->count())->toBe(1);

    $response->assertDispatched('profile-updated');
});

test('it creates activity log', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Schedule::class, [
        'user' => $user,
        'weekDays' => $this->weekDays,
    ])
        ->set('timezone', 'Asia/Kolkata')
        ->set('advance_booking_window', AdvanceBookingWindow::TWENTYFOURHOURS->value)
        ->set('maximum_booking_window', MaximumBookingWindow::TWOWEEKS->value)
        ->set('daily_session_limit', 2)
        ->call('saveSchedule');

    $response->assertHasNoErrors();

    $this->assertDatabaseHas('activity_log', [
        'subject_type' => MentorSchedule::class,
        'event' => 'created',
    ]);
});
