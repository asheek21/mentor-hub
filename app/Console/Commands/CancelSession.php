<?php

namespace App\Console\Commands;

use App\Enums\BookingStatus;
use App\Events\SessionCancelled;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelSession extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-session';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will cancel all the session which is not confirmed by the mentor.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twentyFourHour = Carbon::now()->subDay()->startOfHour();

        Booking::whereStatus(BookingStatus::PENDING)
            ->where('schedule', '<=', $twentyFourHour)
            ->cursor()
            ->each(function (Booking $booking) {
                $booking->status = BookingStatus::AUTOCANCELLED;
                $booking->cancellation_reason = 'Session not confirmed by the mentor';
                $booking->save();

                SessionCancelled::dispatch($booking, BookingStatus::AUTOCANCELLED);

            });
    }
}
