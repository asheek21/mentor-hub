<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mentor_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->json('schedule')->nullable();
            $table->string('timezone')->nullable();
            $table->string('advance_booking_window');
            $table->string('maximum_booking_window');
            $table->string('buffer_time')->nullable();
            $table->integer('daily_session_limit')->default(0);
            $table->boolean('automatically_mark_slot')->default(true);
            $table->boolean('send_notification')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_schedules');
    }
};
