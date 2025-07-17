<?php

namespace App\Actions;

use App\Models\User;

class UpdateMentorSpecializationAction
{
    public function execute(User $mentor, array $specialization): void
    {
        if (! empty($specialization['others'])) {
            $specialization['others'] = explode(',', $specialization['others']);
        }

        $mentor->mentorProfile()->update([
            'specialization' => $specialization,
        ]);
    }
}
