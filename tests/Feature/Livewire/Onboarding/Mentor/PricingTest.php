<?php

use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentor\Pricing;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\MentorProfile;
use App\Models\User;
use Livewire\Livewire;
use Masmerise\Toaster\Toaster;

test('it can save pricing', function () {

    $mentor = User::factory()
        ->has(MentorProfile::factory())
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    Toaster::fake();

    Livewire::test(Pricing::class, [
        'user' => $mentor,
    ])
        ->set('hourly_rate', 500)
        ->set('session_duration', 60)
        ->call('updatePricing')
        ->assertStatus(200)
        ->assertHasNoErrors()
        ->assertDispatchedTo(OnboardingPage::class, 'profile-updated');

    $mentor->mentorProfile->refresh();

    expect($mentor->mentorProfile->hourly_rate)->toBe('500.00');
    expect($mentor->mentorProfile->session_duration)->toBe(60);

    Toaster::assertDispatched('profile updated! Welcome to the community!');
});

test('it validates both hourly rate and session duration', function () {
    $mentor = User::factory()
        ->has(MentorProfile::factory())
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    Livewire::test(Pricing::class, [
        'user' => $mentor,
    ])
        ->set('hourly_rate', '')
        ->set('session_duration', '')
        ->call('updatePricing')
        ->assertStatus(200)
        ->assertHasErrors();
});
