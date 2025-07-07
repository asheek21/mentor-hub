<?php

namespace App\Models;

use App\Enums\YearsOfExperience;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $current_role
 * @property string|null $company
 * @property YearsOfExperience|null $years_of_experience
 * @property string $bio
 * @property \Illuminate\Support\Collection $specialization
 * @property string|null $hourly_rate
 * @property int|null $session_duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $current_status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\UserProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCurrentRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereHourlyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereSessionDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereYearsOfExperience($value)
 *
 * @mixin \Eloquent
 */
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
        'current_status',
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
