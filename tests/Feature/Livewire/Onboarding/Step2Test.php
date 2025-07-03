<?php

use App\Enums\UserRole;
use App\Livewire\Onboarding\Step2;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {

    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($user);

    Livewire::test(Step2::class, [
        'user' => $user,
    ])
        ->assertStatus(200);
});
