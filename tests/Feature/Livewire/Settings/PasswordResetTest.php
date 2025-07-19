<?php

use App\Livewire\Settings\PasswordReset;
use Livewire\Livewire;

test('it can reset mentee password', function () {
    mentee();

    $user = auth()->user();

    $password = 'password';

    Livewire::test(PasswordReset::class, [
        'user' => $user,
    ])
        ->set('current_password', $password)
        ->set('password', 'Qwert!123')
        ->set('password_confirmation', 'Qwert!123')
        ->call('updateSettingsPassword')
        ->assertStatus(200)
        ->assertHasNoErrors();
});

test('it validates reset password request', function () {
    mentee();

    $user = auth()->user();

    $wrongPassword = 'password123';

    Livewire::test(PasswordReset::class, [
        'user' => $user,
    ])
        ->set('current_password', $wrongPassword)
        ->set('password', 'password')
        ->set('password_confirmation', 'Qwert!123')
        ->call('updateSettingsPassword')
        ->assertStatus(200)
        ->assertHasErrors(['current_password' => 'current_password', 'password']);
});
