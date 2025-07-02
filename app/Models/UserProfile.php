<?php

namespace App\Models;

use App\Enums\YearsOfExperience;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserProfileFactory> */
    use HasFactory;

    use LogsActivity;

    protected $fillable = [
        'current_role',
        'company',
        'years_of_experience',
        'bio',
        'specialization',
        'hourly_rate',
        'session_duration',
    ];

    protected function casts()
    {
        return [
            'years_of_experience' => YearsOfExperience::class,
            'specialization' => AsCollection::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
