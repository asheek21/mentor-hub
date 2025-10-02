<?php

namespace Database\Factories;

use App\Enums\BookingPaymentStatus;
use App\Enums\BookingStatus;
use App\Models\MenteeBookingSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentee_booking_session_uuid' => MenteeBookingSession::factory()->create()->uuid,
            'price' => fake()->numberBetween(5000, 10000),
            'status' => BookingStatus::PENDING,
            'payment_status' => BookingPaymentStatus::INITIATED,
            'schedule' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'duration' => 60,
            'meeting_notes' => '',
            'meeting_heading' => 'Some heading',
            'reference_number' => strtoupper(uniqid('BK-')),
        ];
    }
}
