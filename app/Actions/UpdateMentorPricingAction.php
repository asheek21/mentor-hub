<?php

namespace App\Actions;

use App\Models\User;

class UpdateMentorPricingAction
{
    public function execute(User $mentor, array $data): void
    {
        $mentor->mentorProfile()->update($data);
    }
}
