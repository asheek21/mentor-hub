<?php

use App\Enums\MenteeBookingSessionStatus;
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
        Schema::create('mentee_booking_sessions', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignIdFor(User::class, 'mentee_id');
            $table->unsignedBigInteger('mentor_id');
            $table->string('slot')->nullable();
            $table->decimal('price');
            $table->string('status')->default(MenteeBookingSessionStatus::PENDING->value);
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_sessions');
    }
};
