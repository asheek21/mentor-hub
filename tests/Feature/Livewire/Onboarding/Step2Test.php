<?php

use App\Enums\UserRole;
use App\Livewire\Onboarding\Step2;
use App\Models\User;
use Livewire\Livewire;

test('mentee cannot access this page', function () {

    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($user);

    Livewire::test(Step2::class, [
        'user' => $user,
    ])
        ->assertRedirect(route('dashboard', absolute: false));
});
