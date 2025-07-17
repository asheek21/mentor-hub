<?php

namespace App\Actions;

use App\Models\User;

class UpdateMenteePreferenceAction
{
    public function execute(User $mentee, array $data): void
    {
        $mentee->menteeProfile()->update($data);
    }
}
