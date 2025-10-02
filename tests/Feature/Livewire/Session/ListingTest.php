<?php

use App\Enums\UserRole;
use App\Livewire\Session\Listing;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

it('will show no sessions', function () {

    mentee();

    Livewire::test(Listing::class)
        ->assertSee('No sessions found')
        ->assertStatus(200);
});

it('will show pending sessions', function () {
    mentee();

    $mentee = Auth::user();

    $mentor = User::factory()->create([
        'user_role' => UserRole::MENTOR,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ]);

    Booking::factory()->create([
        'mentee_id' => $mentee->id,
        'mentor_id' => $mentor->id,
    ]);

    Livewire::test(Listing::class)
        ->assertSee('John Doe')
        ->assertSee([
            'Message',
            'Join Session',
        ])
        ->assertStatus(200);
});
