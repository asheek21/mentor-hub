<?php

use App\Enums\MenteeCurrentStatus;
use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentee\PersonalInformation;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\MenteeProfile;
use App\Models\User;
use Livewire\Livewire;

test('it creates mentee profile', function () {

    $mentee = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($mentee);

    Livewire::test(PersonalInformation::class, [
        'user' => $mentee,
    ])
        ->set('current_role', '')
        ->set('current_status', MenteeCurrentStatus::EarlyCareerProfessional->value)
        ->set('bio', 'This is a bio')
        ->call('storePersonalInformation')
        ->assertStatus(200)
        ->assertHasNoErrors()
        ->assertDispatchedTo(OnboardingPage::class, 'profile-updated');

    $mentee->refresh();

    expect($mentee->menteeProfile->count())->toBe(1);
    expect($mentee->menteeProfile)->toBeInstanceOf(MenteeProfile::class);

    expect([
        'current_role' => $mentee->menteeProfile->current_role,
        'current_status' => $mentee->menteeProfile->current_status,
        'bio' => $mentee->menteeProfile->bio,
    ])->toBe([
        'current_role' => '',
        'current_status' => MenteeCurrentStatus::EarlyCareerProfessional,
        'bio' => 'This is a bio',
    ]);
});

test('it validates the request', function () {

    $mentee = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($mentee);

    Livewire::test(PersonalInformation::class, [
        'user' => $mentee,
    ])
        ->set('current_role', '')
        ->set('current_status', '')
        ->set('bio', 'This is a bio')
        ->call('storePersonalInformation')
        ->assertStatus(200)
        ->assertHasErrors([
            'current_status' => 'required',
        ]);
});
