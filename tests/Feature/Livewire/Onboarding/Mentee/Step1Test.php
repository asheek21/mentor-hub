<?php

use App\Enums\LearningPreference;
use App\Enums\MenteeTimeline;
use App\Enums\SessionFrequency;
use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentee\Step1;
use App\Models\MenteePreference;
use App\Models\MentorProfile;
use App\Models\User;
use Livewire\Livewire;

test('it can complete step1', function () {
    $user = User::factory()->create([
        'user_role' => UserRole::MENTEE,
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Step1::class, [
        'user' => $user,
    ])
        ->set('form.current_role', 'Software Developer')
        ->set('form.current_status', 'high_school_student')
        ->set('form.bio', 'I am a mentee')
        ->set('form.specialization.programming.', 'javascript')
        ->set('form.specialization.design.', 'ui-design')
        ->set('form.learning_preference', LearningPreference::HANDSONPRACTICE->value)
        ->set('form.session_frequency', SessionFrequency::EVERYTWOWEEKSSESSION->value)
        ->set('form.learning_goal', 'Improve my skills')
        ->set('form.challenges', 'I am a mentee')
        ->set('form.timeline', MenteeTimeline::ONE_TWO_MONTHS->value)
        ->call('storeProfileDetails')
        ->assertHasNoErrors();

    $user->refresh();

    $mentorProfile = $user->mentorProfile;

    $menteePreference = $user->menteePreference;

    expect($mentorProfile->count())->toBe(1);
    expect($mentorProfile)->toBeInstanceOf(MentorProfile::class);
    expect($mentorProfile->current_role)->toBe('Software Developer');

    expect($menteePreference->count())->toBe(1);
    expect($menteePreference)->toBeInstanceOf(MenteePreference::class);
    expect($menteePreference->learning_preference)->toBe(LearningPreference::HANDSONPRACTICE);
    expect($menteePreference->session_frequency)->toBe(SessionFrequency::EVERYTWOWEEKSSESSION);
    expect($menteePreference->learning_goal)->toBe('Improve my skills');
    expect($menteePreference->challenges)->toBe('I am a mentee');
    expect($menteePreference->timeline)->toBe(MenteeTimeline::ONE_TWO_MONTHS);

    $response->assertDispatched('profile-updated');
});
