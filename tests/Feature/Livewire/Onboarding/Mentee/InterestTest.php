<?php

use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentee\Interest;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\MenteeProfile;
use App\Models\User;
use Livewire\Livewire;

test('it can store without any intersts', function () {

    $mentee = User::factory()
        ->has(MenteeProfile::factory())
        ->create([
            'user_role' => UserRole::MENTEE,
        ]);

    $this->actingAs($mentee);

    Livewire::test(Interest::class, [
        'user' => $mentee,
    ])
        ->call('updateInterest')
        ->assertStatus(200)
        ->assertHasNoErrors()
        ->assertDispatchedTo(OnboardingPage::class, 'profile-updated');

    expect($mentee->menteeProfile->interests['programming'])->toBe([]);
});

test('it can store interests', function () {
    $mentee = User::factory()
        ->has(MenteeProfile::factory())
        ->create([
            'user_role' => UserRole::MENTEE,
        ]);

    $this->actingAs($mentee);

    Livewire::test(Interest::class, [
        'user' => $mentee,
    ])
        ->set('interests.programming', ['javascript', 'php'])
        ->call('updateInterest')
        ->assertStatus(200)
        ->assertHasNoErrors()
        ->assertDispatchedTo(OnboardingPage::class, 'profile-updated');

    expect($mentee->menteeProfile->interests['programming'])->toBe(['javascript', 'php']);
});
