<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class UserRegisteredDefaultRating
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        /** @var \App\Models\User $user */
        $user = $event->user;

        $user->userRatings()->create([
            'rating' => 0,
            'rated_user_id' => 0,
        ]);
    }
}
