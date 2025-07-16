<?php

namespace App\Actions;

use App\Models\User;

class CreateMentorProfileAction
{
    public function execute(User $user, array $data): void
    {
        $data['work_experience'] = $data['experiences'];

        unset($data['experiences']);

        foreach ($data['work_experience'] as $key => $work_experience) {
            $endDate = $work_experience['end_date'];

            if (! empty($endDate) && $work_experience['current_position']) {
                $data['work_experience'][$key]['current_position'] = false;
            }
        }

        $user->mentorProfile()->delete();

        $user->mentorProfile()->create($data);
    }
}
