<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use App\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property string $uuid
 * @property string $first_name
 * @property string|null $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property UserRole $user_role
 * @property OnboardingStage $onboarding_stage
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read string|null $profile_picture
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\MenteeProfile|null $menteeProfile
 * @property-read \App\Models\MentorProfile|null $mentorProfile
 * @property-read \App\Models\MentorSchedule|null $mentorSchedule
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserRating> $userRatings
 * @property-read int|null $user_ratings_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User byUUID($uuid)
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User mentor()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOnboardingStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUuid($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    use HasUuid;
    use InteractsWithMedia;

    const MEDIA_LIBRARY_PROFILE = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_role',
        'email',
        'onboarding_stage',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_role' => UserRole::class,
            'onboarding_stage' => OnboardingStage::class,
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return collect([$this->first_name, $this->last_name])
            ->filter()
            ->map(fn ($name) => Str::upper(Str::substr($name, 0, 1)))
            ->implode('');
    }

    public function scopeMentor($query): Builder
    {
        return $query->where('user_role', UserRole::MENTOR);
    }

    public function isMentor(): bool
    {
        return $this->user_role === UserRole::MENTOR;
    }

    public function isMentee(): bool
    {
        return $this->user_role === UserRole::MENTEE;
    }

    public function getFullNameAttribute(): string
    {
        return Str::title("{$this->first_name} {$this->last_name}");
    }

    public function getProfilePictureAttribute(): ?string
    {
        $name = $this->full_name;

        return ! empty($this->getFirstMediaUrl(self::MEDIA_LIBRARY_PROFILE)) ?
            $this->getFirstMediaUrl(self::MEDIA_LIBRARY_PROFILE) : 'https://ui-avatars.com/api/?name='.$name;
    }

    public function mentorProfile(): HasOne
    {
        return $this->hasOne(MentorProfile::class);
    }

    public function menteeProfile(): HasOne
    {
        return $this->hasOne(MenteeProfile::class);
    }

    public function mentorSchedule(): HasOne
    {
        return $this->hasOne(MentorSchedule::class);
    }

    public function userRatings(): HasMany
    {
        return $this->hasMany(UserRating::class)
            ->where('rated_user_id', '<>', 0);
    }

    public function averageRating(int $percentageNeeded = 0): float
    {
        $average = Cache::remember("user_{$this->id}_average_rating", now()->addHour(), function () {
            return $this->userRatings()->avg('rating') ?? 0;
        });

        return $percentageNeeded == 1 ? $average * 100 : $average;
    }

    public function mentorSkills()
    {
        return Cache::remember("user_{$this->id}_mentor_skills", now()->addHours(6), function () {

            $specialization = $this->mentorProfile->specialization;

            return $specialization->flatMap(function ($skill) {
                return $skill;
            })->filter()->values();
        });

    }
}
