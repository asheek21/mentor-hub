<?php

namespace App\Livewire\Auth;

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Attributes\On;
use Livewire\Component;

class Register extends Component
{
    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $password = '';

    public string $user_role = UserRole::MENTEE->value;

    public string $password_confirmation = '';

    public bool $hidden = true;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed',
                Rules\Password::min(6)
                    ->mixedCase()
                    ->symbols(),
            ],
            'user_role' => ['Required', Rule::enum(UserRole::class)],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['onboarding_stage'] = OnboardingStage::FIRST_STEP;

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    #[On('open-register-modal')]
    public function openLoginModal()
    {
        $this->hidden = false;
    }

    public function hide()
    {
        $this->hidden = true;
    }

    public function existingUser()
    {
        $this->hide();

        $this->dispatch('open-login-modal')->to(Login::class);
    }
}
