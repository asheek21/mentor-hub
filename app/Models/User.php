<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\OnboardingStage;
use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property OnboardingStage $onboarding_stage
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
        'password',
        'onboarding_stage',
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

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getProfilePictureAttribute(): ?string
    {
        $name = $this->full_name;

        return ! empty($this->getFirstMediaUrl(self::MEDIA_LIBRARY_PROFILE)) ?
            $this->getFirstMediaUrl(self::MEDIA_LIBRARY_PROFILE) : "https://ui-avatars.com/api/?name={{ $name }}";
    }

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
}
