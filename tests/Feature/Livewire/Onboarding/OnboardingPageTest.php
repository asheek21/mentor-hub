<?php

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Livewire\Livewire;

test('onboarding page redirects to dashboard for mentor after steps completed', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::THIRD_STEP,
    ]);

    $this->actingAs($user);

    Livewire::test(OnboardingPage::class)
        ->dispatch('profile-updated', ['completedStep' => 4])
        ->assertSet('user.onboarding_stage', OnboardingStage::COMPLETED)
        ->assertRedirect(route('dashboard', absolute: false));
});

test('onboarding page redirects to dashboard for mentee after steps completed', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
        'onboarding_stage' => OnboardingStage::SECOND_STEP,
    ]);

    $this->actingAs($user);

    Livewire::test(OnboardingPage::class)
        ->dispatch('profile-updated', ['completedStep' => 3])
        ->assertSet('user.onboarding_stage', OnboardingStage::COMPLETED)
        ->assertRedirect(route('dashboard', absolute: false));
});
