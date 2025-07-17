<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\mentorProfile>
 */
class MentorProfileFactory extends Factory
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
            'work_experience' => [
                [
                    'job_title' => $this->faker->jobTitle(),
                    'company_name' => $this->faker->company(),
                    'start_date' => $this->faker->date(),
                    'end_date' => null,
                    'current_position' => true,
                    'description' => $this->faker->paragraph(),
                ],
            ],
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
