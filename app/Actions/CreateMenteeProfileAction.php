<?php

namespace App\Actions;

use App\Models\User;

class CreateMenteeProfileAction
{
    public function execute(User $user, array $data): void
    {
        $user->menteeProfile()->delete();

        $user->menteeProfile()->create($data);
    }
}
