<?php

use App\Enums\UserRole;
use App\Livewire\Mentor\Browse;
use App\Models\User;
use Livewire\Livewire;

test('only mentee can access browse mentor page', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($user);

    Livewire::test(Browse::class)
        ->assertSee('Hi');
});

test('mentors cannot access browse mentor page', function () {

    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
    ]);

    $this->actingAs($user);

    Livewire::test(Browse::class)
        ->assertForbidden();
});
