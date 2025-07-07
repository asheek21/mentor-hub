<?php

use App\Http\Middleware\OnboardingStateMiddleware;
use App\Livewire\Landing\LandingPage;
use App\Livewire\Onboarding\OnboardingPage;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', LandingPage::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/onboarding', OnboardingPage::class)->name('onboarding');

    Route::middleware(OnboardingStateMiddleware::class)->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');

        Route::redirect('settings', 'settings/profile');

        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });
});

require __DIR__.'/auth.php';
