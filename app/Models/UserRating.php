<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
