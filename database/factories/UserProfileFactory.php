<?php

namespace Database\Factories;

use App\Enums\YearsOfExperience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
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
            'current_status' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'years_of_experience' => $this->faker->randomElement(YearsOfExperience::cases()),
            'bio' => $this->faker->text(),
            'specialization' => [
                'programming' => [
                    'javascript',
                ],
                'design' => [
                    'figma',
                ],
            ],
            'hourly_rate' => $this->faker->numberBetween(100, 1000),
            'session_duration' => $this->faker->numberBetween(30, 120),
        ];
    }
}
