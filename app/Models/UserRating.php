<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $rated_user_id
 * @property int $rating
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\UserRatingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereRatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserRating whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserRating extends Model
{
    /** @use HasFactory<\Database\Factories\UserRatingFactory> */
    use HasFactory;

    protected $fillable = [
        'rated_user_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
