<?php

use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentor\PersonalInformation;
use App\Models\MentorProfile;
use App\Models\User;
use Livewire\Livewire;

test('it can create mentor profile and update status', function () {
    $mentor = User::factory()->create([
        'user_role' => UserRole::MENTOR,
    ]);

    $this->actingAs($mentor);

    Livewire::test(PersonalInformation::class, [
        'user' => $mentor,
    ])
        ->set('form.current_role', 'Software Developer')
        ->set('form.bio', fake()->sentence())
        ->set('form.experiences.0.job_title', fake()->jobTitle())
        ->set('form.experiences.0.company_name', fake()->company())
        ->set('form.experiences.0.start_date', fake()->date())
        ->set('form.experiences.0.end_date', null)
        ->set('form.experiences.0.current_position', true)
        ->set('form.experiences.0.description', fake()->paragraph())
        ->call('storeProfessionalDetails')
        ->assertStatus(200)
        ->assertDispatched('profile-updated');

    $mentor->refresh();

    expect($mentor->mentorProfile)->toBeInstanceOf(MentorProfile::class);
    expect($mentor->mentorProfile->count())->toBe(1);
});

test('it validates the request', function () {
    $mentor = User::factory()->create([
        'user_role' => UserRole::MENTOR,
    ]);

    $this->actingAs($mentor);

    Livewire::test(PersonalInformation::class, [
        'user' => $mentor,
    ])
        ->set('form.current_role', 'Software Developer')
        ->set('form.bio', fake()->sentence())
        ->set('form.experiences.0.job_title', null)
        ->set('form.experiences.0.company_name', fake()->company())
        ->set('form.experiences.0.start_date', fake()->date())
        ->set('form.experiences.0.end_date', null)
        ->set('form.experiences.0.current_position', true)
        ->set('form.experiences.0.description', fake()->paragraph())
        ->call('storeProfessionalDetails')
        ->assertStatus(200)
        ->assertHasErrors([
            'form.experiences.0.job_title' => 'required',
        ]);
});

test('it can complete with either end date or current position', function () {
    $mentor = User::factory()->create([
        'user_role' => UserRole::MENTOR,
    ]);

    $this->actingAs($mentor);

    Livewire::test(PersonalInformation::class, [
        'user' => $mentor,
    ])
        ->set('form.current_role', 'Software Developer')
        ->set('form.bio', fake()->sentence())
        ->set('form.experiences.0.job_title', fake()->jobTitle())
        ->set('form.experiences.0.company_name', fake()->company())
        ->set('form.experiences.0.start_date', fake()->date())
        ->set('form.experiences.0.end_date', fake()->date())
        ->set('form.experiences.0.current_position', true)
        ->set('form.experiences.0.description', fake()->paragraph())
        ->call('storeProfessionalDetails')
        ->assertStatus(200)
        ->assertHasNoErrors();

    $mentor->refresh();

    $mentorProfile = $mentor->mentorProfile;

    expect($mentorProfile->work_experience[0]['current_position'])->toBe(false);

});
