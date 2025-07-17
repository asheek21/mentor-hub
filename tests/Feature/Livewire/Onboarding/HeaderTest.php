<?php

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Livewire\Onboarding\Header;
use App\Models\User;
use Livewire\Livewire;

test('it shows mentor steps correctly', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'onboarding_stage' => OnboardingStage::FIRST_STEP,
    ]);

    $this->actingAs($user);

    $currentStep = $user->onboarding_stage->step();

    $response = Livewire::test(Header::class, [
        'currentStep' => $currentStep,
        'totalStep' => 3,
    ]);

    if ($currentStep == 1) {
        $response->assertSeeText('Step 1 of 3');
    }

    if ($currentStep == 2) {
        $response->assertSeeText('Step 2 of 3');
    }

    if ($currentStep == 3) {
        $response->assertSeeText('Step 3 of 3');
    }

    $response->assertOk();
});

test('it shows mentee steps correctly', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($user);

    $currentStep = $user->onboarding_stage->step();

    $response = Livewire::test(Header::class, [
        'currentStep' => $currentStep,
        'totalStep' => 1,
    ]);

    if ($currentStep == 1) {
        $response->assertSeeText('Step 1 of 1');
    }

    $response->assertOk();
});
