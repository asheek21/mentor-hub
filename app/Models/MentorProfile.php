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
 * @property string $current_role
 * @property \Illuminate\Support\Collection $work_experience
 * @property string $bio
 * @property \Illuminate\Support\Collection|null $specialization
 * @property string|null $hourly_rate
 * @property int|null $session_duration
 * @property bool $mentor_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property YearsOfExperience $years_of_experience
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\MentorProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereCurrentRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereHourlyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereMentorStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereSessionDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorProfile whereWorkExperience($value)
 *
 * @mixin \Eloquent
 */
class MentorProfile extends Model
{
    /** @use HasFactory<\Database\Factories\MentorProfileFactory> */
    use HasFactory;

    use LogsActivity;

    protected $fillable = [
        'current_role',
        'work_experience',
        'bio',
        'specialization',
        'hourly_rate',
        'session_duration',
        'mentor_status',
    ];

    protected function casts()
    {
        return [
            'years_of_experience' => YearsOfExperience::class,
            'specialization' => AsCollection::class,
            'work_experience' => AsCollection::class,
            'mentor_status' => 'bool',
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
