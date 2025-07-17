<?php

namespace App\Actions;

use App\Models\User;

class UpdateMenteeInterestAction
{
    public function execute(User $mentor, array $interest): void
    {
        if (! empty($interest['others'])) {
            $interest['others'] = explode(',', $interest['others']);
        }

        $mentor->menteeProfile()->update([
            'interests' => $interest,
        ]);
    }
}
