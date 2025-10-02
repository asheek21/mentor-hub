<?php

namespace App\Models;

use App\Enums\BookingTransactionStatus;
use App\Enums\BookingTransactionType;
use App\Enums\PaymentProvider;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $booking_id
 * @property PaymentProvider $provider
 * @property BookingTransactionType $type
 * @property string $price
 * @property BookingTransactionStatus $status
 * @property string $reference_id
 * @property \Illuminate\Support\Collection|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Booking|null $booking
 *
 * @method static \Database\Factories\BookingTransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingTransaction whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class BookingTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\BookingTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'provider',
        'type',
        'price',
        'status',
        'reference_id',
        'metadata',
    ];

    protected $casts = [
        'type' => BookingTransactionType::class,
        'status' => BookingTransactionStatus::class,
        'metadata' => AsCollection::class,
        'provider' => PaymentProvider::class,
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
