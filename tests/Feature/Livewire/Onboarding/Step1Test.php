<?php

use App\Enums\YearsOfExperience;
use App\Livewire\Onboarding\Step1;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

test('it can upload profile picture', function () {
    $user = User::factory()->create();

    $file = UploadedFile::fake()->image('profile.jpg');

    $component = new Step1;
    $component->user = $user;
    $component->profilePicture = $file;

    $component->updatedProfilePicture();

    $this->assertTrue($user->hasMedia(User::MEDIA_LIBRARY_PROFILE));
});

test('it can complete step1', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Step1::class, [
        'user' => $user,
    ])
        ->set('form.current_role', 'Software Developer')
        ->set('form.company', 'Google')
        ->set('form.years_of_experience', YearsOfExperience::ONETOTWOYEARS->value)
        ->set('form.bio', 'I am a software developer')
        ->set('form.specialization.programming.', 'javascript')
        ->set('form.specialization.design.', 'ui-design')
        ->set('form.hourly_rate', 500)
        ->set('form.session_duration', 60)
        ->call('storeProfileDetails')
        ->assertHasNoErrors();

    $user->refresh();

    $userProfile = $user->userProfile;

    expect($userProfile->count())->toBe(1);
    expect($userProfile)->toBeInstanceOf(UserProfile::class);

    $response->assertDispatched('profile-updated');
});
