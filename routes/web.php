<?php

use App\Http\Middleware\OnboardingStateMiddleware;
use App\Livewire\Dashboard\DashboardPage;
use App\Livewire\Landing\LandingPage;
use App\Livewire\Mentor\Browse;
use App\Livewire\Onboarding\OnboardingPage;
use App\Livewire\Session\SessionPage;
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
        // Route::view('dashboard', 'dashboard')->name('dashboard');

        Route::get('/dashboard', DashboardPage::class)->name('dashboard');

        Route::get('sessions', SessionPage::class)->name('sessions');

        Route::get('courses', function () {
            return 1;
        })->name('courses');

        Route::get('messages', function () {
            return 1;
        })->name('messages');

        Route::get('browse-mentors', Browse::class)->name('browse-mentors');

        Route::redirect('settings', 'settings/profile');

        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });
});

require __DIR__.'/auth.php';
