<?php

use App\Enums\UserRole;
use App\Livewire\Mentor\Listing;
use App\Models\User;
use App\Models\UserProfile;
use Livewire\Livewire;

test('it list mentors successfully', function () {
    $mentee = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($mentee);

    $mentor1 = User::factory()
        ->has(UserProfile::factory())
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    $mentor2 = User::factory()
        ->has(UserProfile::factory())
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    Livewire::test(Listing::class)
        ->assertSee($mentor1->name)
        ->assertSee($mentor1->userProfile->bio)
        ->assertSee($mentor2->name)
        ->assertSee($mentor2->userProfile->bio)
        ->assertStatus(200);
});

test('it can filter based on search query', function () {

    $mentee = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($mentee);

    $mentor1 = User::factory()
        ->has(UserProfile::factory())
        ->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'user_role' => UserRole::MENTOR,
        ]);

    $mentor2 = User::factory()
        ->has(UserProfile::factory())
        ->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'user_role' => UserRole::MENTOR,
        ]);

    Livewire::test(Listing::class, [
        'filters' => ['search' => 'John Doe'],
    ])
        ->assertSee($mentor1->full_name)
        ->assertDontSee($mentor2->full_name)
        ->assertStatus(200);
});

test('it can work with filter', function () {
    $mentee = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($mentee);

    $mentor1 = User::factory()
        ->has(UserProfile::factory()
            ->state(function () {
                return [
                    'specialization' => [
                        'programming' => [
                            'laravel',
                            'php',
                        ],
                    ], 'hourly_rate' => 1500,

                ];
            }))
        ->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'user_role' => UserRole::MENTOR,
        ]);

    $mentor2 = User::factory()
        ->has(UserProfile::factory())
        ->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'user_role' => UserRole::MENTOR,
        ]);

    Livewire::test(Listing::class, [
        'filters' => ['search' => 'John Doe', 'skill' => 'laravel', 'price' => 'high'],
    ])
        ->assertSee($mentor1->full_name)
        ->assertDontSee($mentor2->full_name)
        ->assertStatus(200);
});
