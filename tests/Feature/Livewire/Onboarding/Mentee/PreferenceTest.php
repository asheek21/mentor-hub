<?php

use App\Enums\LearningPreference;
use App\Enums\SessionFrequency;
use App\Enums\UserRole;
use App\Livewire\Onboarding\Mentee\Preference;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\MenteeProfile;
use App\Models\User;
use Livewire\Livewire;

test('it can store mentee preferences', function () {

    $mentee = User::factory()
        ->has(MenteeProfile::factory())
        ->create([
            'user_role' => UserRole::MENTEE,
        ]);

    $this->actingAs($mentee);

    Livewire::test(Preference::class, [
        'user' => $mentee,
    ])
        ->set('form.learning_goal', 'Improve my skills')
        ->set('form.challenges', 'I am a mentee')
        ->set('form.learning_preference', LearningPreference::DISCUSSIONQANDA->value)
        ->set('form.session_frequency', SessionFrequency::EVERYTWOWEEKSSESSION->value)
        ->call('updatePreference')
        ->assertStatus(200)
        ->assertHasNoErrors()
        ->assertDispatchedTo(OnboardingPage::class, 'profile-updated');

    $mentee->refresh();

    expect($mentee->menteeProfile->learning_goal)->toBe('Improve my skills');
    expect($mentee->menteeProfile->challenges)->toBe('I am a mentee');
    expect($mentee->menteeProfile->learning_preference)->toBe(LearningPreference::DISCUSSIONQANDA);
    expect($mentee->menteeProfile->session_frequency)->toBe(SessionFrequency::EVERYTWOWEEKSSESSION);
});
