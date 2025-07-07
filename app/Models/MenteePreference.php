<?php

namespace App\Models;

use App\Enums\LearningPreference;
use App\Enums\MenteeTimeline;
use App\Enums\SessionFrequency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property LearningPreference $learning_preference
 * @property SessionFrequency $session_frequency
 * @property string $learning_goal
 * @property MenteeTimeline $timeline
 * @property string|null $challenges
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\MenteePreferenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereChallenges($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereLearningGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereLearningPreference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereSessionFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereTimeline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenteePreference whereUserId($value)
 *
 * @mixin \Eloquent
 */
class MenteePreference extends Model
{
    /** @use HasFactory<\Database\Factories\MenteePreferenceFactory> */
    use HasFactory;

    protected $fillable = [
        'learning_preference',
        'session_frequency',
        'learning_goal',
        'timeline',
        'challenges',
    ];

    public function casts(): array
    {
        return [
            'learning_preference' => LearningPreference::class,
            'session_frequency' => SessionFrequency::class,
            'timeline' => MenteeTimeline::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
