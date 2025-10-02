<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Booking
 */
class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'schedule' => $this->schedule,
            'duration' => $this->duration,
            'meeting_notes' => $this->meeting_notes,
            'meeting_heading' => $this->meeting_heading,
            'price' => $this->price,
            'payment_status' => $this->payment_status,
            'mentor' => new MentorResource($this->whenLoaded('mentor')),
        ];
    }
}
