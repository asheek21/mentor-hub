<?php

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Livewire;

test('OnboardingPage updates onboarding_stage and currentStep on step 1 for mentor', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    Livewire::test(OnboardingPage::class)
        ->dispatch('profile-updated', ['completedStep' => 1])
        ->assertSet('user.onboarding_stage', OnboardingStage::SECOND_STEP)
        ->assertSet('currentStep', OnboardingStage::SECOND_STEP->step());
});

test('OnboardingPage updates onboarding_stage on step 2 for mentor', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::SECOND_STEP,
    ]);

    $this->actingAs($user);

    Livewire::test(OnboardingPage::class)
        ->dispatch('profile-updated', ['completedStep' => 2])
        ->assertSet('user.onboarding_stage', OnboardingStage::COMPLETED)
        ->assertRedirect(route('dashboard', absolute: false));
});

test('OnboardingPage updates onboarding_stage on step 1 for mentee', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    Livewire::test(OnboardingPage::class)
        ->dispatch('profile-updated', ['completedStep' => 1])
        ->assertSet('user.onboarding_stage', OnboardingStage::COMPLETED)
        ->assertRedirect(route('dashboard', absolute: false));
});
