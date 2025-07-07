<?php

namespace App\Models;

use App\Enums\AdvanceBookingWindow;
use App\Enums\MaximumBookingWindow;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Collection|null $schedule
 * @property string|null $timezone
 * @property AdvanceBookingWindow $advance_booking_window
 * @property MaximumBookingWindow $maximum_booking_window
 * @property string|null $buffer_time
 * @property int $daily_session_limit
 * @property bool $automatically_mark_slot
 * @property bool $send_notification
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Database\Factories\MentorScheduleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereAdvanceBookingWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereAutomaticallyMarkSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereBufferTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereDailySessionLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereMaximumBookingWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereSendNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MentorSchedule whereUserId($value)
 *
 * @mixin \Eloquent
 */
class MentorSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\MentorScheduleFactory> */
    use HasFactory;

    use LogsActivity;

    protected $fillable = [
        'schedule',
        'timezone',
        'advance_booking_window',
        'maximum_booking_window',
        'buffer_time',
        'daily_session_limit',
        'automatically_mark_slot',
        'send_notification',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'schedule' => AsCollection::class,
            'maximum_booking_window' => MaximumBookingWindow::class,
            'advance_booking_window' => AdvanceBookingWindow::class,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
