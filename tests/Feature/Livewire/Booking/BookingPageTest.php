<?php

use App\Enums\UserRole;
use App\Livewire\Booking\BookingPage;
use App\Models\MenteeBookingSession;
use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Masmerise\Toaster\Toaster;

it('redirects to mentor browser page if mentee booking session is not available', function () {

    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($user);

    Toaster::fake();

    Livewire::test(BookingPage::class)
        ->assertRedirect(route('browse-mentors'));

    Toaster::assertDispatched('Session Expired');
});

it('allows booking only if mentee booking session is available', function () {
    mentee();

    $mentee = Auth::user();

    $mentor = User::factory()
        ->has(MentorProfile::factory())
        ->create([
            'user_role' => UserRole::MENTOR,
        ]);

    $MenteeBookingSession = MenteeBookingSession::factory()->create([
        'mentor_id' => $mentor->id,
        'mentee_id' => $mentee->id,
    ]);

    Livewire::withQueryParams(['mSid' => $MenteeBookingSession->uuid])
        ->test(BookingPage::class)
        ->assertOk();
});
