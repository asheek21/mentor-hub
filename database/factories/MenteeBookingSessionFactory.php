<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenteeBookingSession>
 */
class MenteeBookingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentee_id' => User::factory()->create([
                'user_role' => UserRole::MENTEE,
            ])->id,
            'mentor_id' => User::factory()->create([
                'user_role' => UserRole::MENTOR,
            ])->id,
            'price' => 5000,
            'expires_at' => now()->addMinutes(5),
        ];
    }
}
