<?php

use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentor\Specialization;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\MentorProfile;
use App\Models\User;
use Livewire\Livewire;
use Masmerise\Toaster\Toaster;

test('it can save specialization', function () {

    $mentor = User::factory()
        ->has(MentorProfile::factory()
            ->state(function () {
                return [
                    'specialization' => [
                        'programming' => [],
                        'design' => [],
                    ],
                ];
            }))
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    $this->actingAs($mentor);

    Toaster::fake();

    Livewire::test(Specialization::class, [
        'user' => $mentor,
    ])
        ->set('specialization.programming.0', 'laravel')
        ->set('specialization.design.0', 'ui-design')
        ->call('updateSpecialization')
        ->assertStatus(200)
        ->assertHasNoErrors()
        ->assertDispatchedTo(OnboardingPage::class, 'profile-updated');

    $mentor->mentorProfile->refresh();

    expect($mentor->mentorProfile->specialization['programming'][0])->toBe('laravel');
    expect($mentor->mentorProfile->specialization['design'][0])->toBe('ui-design');

    Toaster::assertDispatched('profile updated!');
});

test('it needs at least one specialization', function () {
    $mentor = User::factory()
        ->has(MentorProfile::factory()
            ->state(function () {
                return [
                    'specialization' => [
                        'programming' => [],
                        'design' => [],
                    ],
                ];
            }))
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    $this->actingAs($mentor);

    Livewire::test(Specialization::class, [
        'user' => $mentor,
    ])
        ->set('specialization.programming')
        ->set('specialization.design')
        ->set('specialization.career')
        ->set('specialization.others')
        ->call('updateSpecialization')
        ->assertStatus(200)
        ->assertHasErrors();
});
