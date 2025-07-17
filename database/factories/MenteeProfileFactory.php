<?php

namespace Database\Factories;

use App\Enums\MenteeCurrentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenteeProfile>
 */
class MenteeProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'current_role' => $this->faker->jobTitle(),
            'bio' => $this->faker->text(),
            'current_status' => fake()->randomElement(MenteeCurrentStatus::cases()),
            'interests' => [
                'programming' => [],
                'design' => [],
                'career' => [],
                'others' => [],
            ],
        ];
    }
}
