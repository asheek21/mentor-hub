<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PasswordReset extends Component
{
    public User $user;

    public string $current_password;

    public string $password;

    public string $password_confirmation;

    public function render()
    {
        return view('livewire.settings.password-reset');
    }

    public function updateSettingsPassword()
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', PasswordRule::min(6)
                    ->mixedCase()
                    ->symbols(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        $this->user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        Toaster::success('Password updated!');
    }
}
