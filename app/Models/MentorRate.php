<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $mentor_profile_id
 * @property string $amount
 * @property string $currency
 * @property string $stripe_price_id
 * @property string|null $stripe_product_id
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MentorProfile|null $mentorProfile
 *
 * @method static \Database\Factories\MentorRateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereMentorProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereStripePriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereStripeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorRate whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MentorRate extends Model
{
    /** @use HasFactory<\Database\Factories\MentorRateFactory> */
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency',
        'stripe_price_id',
        'stripe_product_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function mentorProfile(): BelongsTo
    {
        return $this->belongsTo(MentorProfile::class);
    }
}
