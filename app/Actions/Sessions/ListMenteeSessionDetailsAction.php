<?php

namespace App\Actions\Sessions;

use App\Enums\BookingStatus;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListMenteeSessionDetailsAction
{
    public function execute(User $mentee, string $tab = ''): AnonymousResourceCollection
    {
        $booking = Booking::where('mentee_id', $mentee->id)
            ->with(['mentor' => function ($user) {
                $user->select('id', 'first_name', 'last_name');
            }])
            ->when(! empty($tab) && $tab !== 'all-sessions', function ($query) use ($tab) {
                $statuses = $this->getTabStatus($tab);
                $query->whereIn('status', $statuses);
            })
            ->orderByDesc('id')
            ->paginate(10);

        return BookingResource::collection($booking);
    }

    private function getTabStatus(string $tab): array
    {
        return match ($tab) {
            'upcoming' => [BookingStatus::PENDING, BookingStatus::CONFIRMED] ,
            'completed' => [BookingStatus::COMPLETED] ,
            'cancelled' => [BookingStatus::CANCELLED],
            default => [],
        };
    }
}
