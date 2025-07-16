<?php

use App\Actions\CreateMentorProfileAction;
use App\Enums\UserRole;
use App\Models\MentorProfile;
use App\Models\User;

test('it can create mentor profile', function () {
    $data = [
        'current_role' => 'Laravel Developer',
        'bio' => fake()->text(),
        'experiences' => [
            [
                'job_title' => fake()->jobTitle(),
                'company_name' => fake()->company(),
                'start_date' => fake()->date(),
                'end_date' => null,
                'current_position' => true,
                'description' => fake()->paragraph(),
            ],
        ],
    ];

    $user = User::factory()->create([
        'user_role' => UserRole::MENTOR,
    ]);

    (app(CreateMentorProfileAction::class))->execute($user, $data);

    $user->refresh();

    expect($user->mentorProfile->current_role)->toBe($data['current_role']);
    expect($user->mentorProfile->bio)->toBe($data['bio']);

    expect($user->mentorProfile)->toBeInstanceOf(MentorProfile::class);
});
