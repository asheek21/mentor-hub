<?php

use App\Http\Middleware\OnboardingStateMiddleware;
use App\Livewire\Dashboard\DashboardPage;
use App\Livewire\Landing\LandingPage;
use App\Livewire\Mentor\Browse;
use App\Livewire\MentorProfile\MentorProfilePage;
use App\Livewire\Onboarding\OnboardingPage;
use App\Livewire\Session\SessionPage;
use App\Livewire\Settings\SettingsPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', LandingPage::class)->name('home');

Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/onboarding', OnboardingPage::class)->name('onboarding');

    Route::middleware(OnboardingStateMiddleware::class)->group(function () {
        // Route::view('dashboard', 'dashboard')->name('dashboard');

        Route::get('/dashboard', DashboardPage::class)->name('dashboard');

        Route::get('sessions', SessionPage::class)->name('sessions');

        Route::get('browse-mentors', Browse::class)->name('browse-mentors');

        Route::prefix('mentor')->group(function () {
            Route::get('{user:uuid}', MentorProfilePage::class)->name('mentor.profile');
        });

        Route::get('courses', function () {
            return 1;
        })->name('courses');

        Route::get('messages', function () {
            return 1;
        })->name('messages');

        Route::get('settings', SettingsPage::class)->name('settings');
    });
});

require __DIR__.'/auth.php';
