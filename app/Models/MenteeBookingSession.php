<?php

namespace App\Models;

use App\Enums\MenteeBookingSessionStatus;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $uuid
 * @property int $mentee_id
 * @property int $mentor_id
 * @property string|null $slot
 * @property string $price
 * @property MenteeBookingSessionStatus $status
 * @property \Illuminate\Support\Carbon $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Booking|null $booking
 * @property-read \App\Models\User|null $mentee
 * @property-read \App\Models\User|null $mentor
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession byUUID($uuid)
 * @method static \Database\Factories\MenteeBookingSessionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereMenteeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeBookingSession whereUuid($value)
 *
 * @mixin \Eloquent
 */
class MenteeBookingSession extends Model
{
    /** @use HasFactory<\Database\Factories\MenteeBookingSessionFactory> */
    use HasFactory;

    use HasUuid;

    protected $primaryKey = 'uuid';

    protected string $uuidFieldName = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'price',
        'slot',
        'status',
        'expires_at',
        'mentor_id',
    ];

    protected function casts()
    {
        return [
            'status' => MenteeBookingSessionStatus::class,
            'expires_at' => 'datetime',
        ];
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    public function isValid()
    {
        return $this->status === MenteeBookingSessionStatus::PENDING &&
        $this->expires_at > now();
    }

    public function invalidate()
    {
        $this->status = MenteeBookingSessionStatus::FAILED;
        $this->save();
    }

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
