<?php

use App\Enums\UserRole;
use App\Livewire\Components\MentorCard;
use App\Models\User;
use App\Models\UserProfile;
use Livewire\Livewire;

test('it shows mentor details', function () {

    $mentee = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($mentee);

    $mentor = User::factory()
        ->has(UserProfile::factory()
            ->state(function () {
                return [
                    'current_role' => 'Laravel Developer',
                ];
            }))
        ->create([
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'user_role' => UserRole::MENTOR,
        ]);

    Livewire::test(MentorCard::class, ['mentor' => $mentor])
        ->assertSee('Jhon Doe')
        ->assertSee('Laravel Developer')
        ->assertStatus(200);
});
