<?php

namespace App\Actions\Booking;

use App\Models\MenteeBookingSession;

class UpdateMenteeBookingSessionAction
{
    public function execute(MenteeBookingSession $menteeBookingSession, array $data)
    {
        $menteeBookingSession->update($data);
    }
}
