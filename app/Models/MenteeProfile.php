<?php

namespace App\Models;

use App\Enums\LearningPreference;
use App\Enums\MenteeCurrentStatus;
use App\Enums\SessionFrequency;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property MenteeCurrentStatus $current_status
 * @property string $bio
 * @property string|null $current_role
 * @property \Illuminate\Support\Collection|null $interests
 * @property LearningPreference|null $learning_preference
 * @property SessionFrequency|null $session_frequency
 * @property string|null $learning_goal
 * @property string|null $timeline
 * @property string|null $challenges
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\MenteeProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereChallenges($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereCurrentRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereInterests($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereLearningGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereLearningPreference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereSessionFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereTimeline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteeProfile whereUserId($value)
 *
 * @mixin \Eloquent
 */
class MenteeProfile extends Model
{
    /** @use HasFactory<\Database\Factories\MenteeProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'current_status',
        'current_role',
        'bio',
        'learning_preference',
        'session_frequency',
        'learning_goal',
        'challenges',
    ];

    public function casts(): array
    {
        return [
            'learning_preference' => LearningPreference::class,
            'session_frequency' => SessionFrequency::class,
            'current_status' => MenteeCurrentStatus::class,
            'interests' => AsCollection::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
