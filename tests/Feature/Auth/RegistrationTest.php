<?php

use App\Enums\UserRole;
use App\Livewire\Auth\Register;
use App\Models\User;
use Livewire\Livewire;

test('registration fails with invalid data', function () {
    Livewire::test(Register::class)
        ->set('first_name', '')
        ->set('email', 'invalid-email')
        ->set('password', '123')
        ->set('password_confirmation', '456')
        ->set('user_role', '')
        ->call('register')
        ->assertHasErrors([
            'first_name' => 'required',
            'email' => 'email',
            'user_role' => 'required',
        ]);

    expect(User::where('email', 'invalid-email')->first())->toBeNull();
    $this->assertGuest();
});

test('registration fails with weak password', function () {
    Livewire::test(Register::class)
        ->set('first_name', 'Test')
        ->set('last_name', 'User')
        ->set('email', 'test@example.com')
        ->set('password', '123456')
        ->set('password_confirmation', '123456')
        ->set('user_role', UserRole::MENTEE->value)
        ->call('register')
        ->assertHasErrors(['password']);

    expect(User::where('email', 'test@example.com')->first())->toBeNull();
});

test('registration fails with duplicate email', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(Register::class)
        ->set('first_name', 'Test')
        ->set('last_name', 'User')
        ->set('email', 'existing@example.com')
        ->set('password', 'Qwert!123')
        ->set('password_confirmation', 'Qwert!123')
        ->set('user_role', UserRole::MENTEE->value)
        ->call('register')
        ->assertHasErrors(['email' => 'unique']);
});

test('new users can register', function () {
    $response = Livewire::test(Register::class)
        ->set('first_name', 'Test User')
        ->set('last_name', 'last name')
        ->set('email', 'test@example.com')
        ->set('password', 'Qwert!123')
        ->set('password_confirmation', 'Qwert!123')
        ->set('user_role', UserRole::MENTEE->value)
        ->call('register');

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull();
    expect($user->user_role)->toBe(UserRole::MENTEE);

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
