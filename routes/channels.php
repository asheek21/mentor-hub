<?php

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('booking.{id}', function (User $user, $bookingId) {
    return (int) $user->id === Booking::find($bookingId)?->mentee_id;
});
