<?php

namespace App\Models;

use App\Enums\BookingPaymentStatus;
use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property int|null $parent_booking_id
 * @property string $mentee_booking_session_uuid
 * @property int $mentee_id
 * @property int $mentor_id
 * @property BookingStatus $status
 * @property BookingPaymentStatus $payment_status
 * @property \Illuminate\Support\Carbon $schedule
 * @property int $duration
 * @property string|null $meeting_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BookingTransaction> $bookingTransactions
 * @property-read int|null $booking_transactions_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 *
 * @method static \Database\Factories\BookingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereMeetingNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereMenteeBookingSessionUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereMenteeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereParentBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Booking whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Booking extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    use InteractsWithMedia;

    const MEDIA_LIBRARY_FILES = 'meeting_files';

    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'status',
        'schedule',
        'mentee_booking_session_uuid',
        'duration',
        'meeting_notes',
        'payment_status',
        'parent_booking_id',
        'price',
        'reference_number',
        'meeting_heading',
        'cancellation_reason',
    ];

    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class,
            'schedule' => 'datetime',
            'payment_status' => BookingPaymentStatus::class,
        ];
    }

    public function bookingTransactions(): HasMany
    {
        return $this->hasMany(BookingTransaction::class);
    }

    public function mentee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
