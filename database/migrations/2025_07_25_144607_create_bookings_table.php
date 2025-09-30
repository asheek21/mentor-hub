<?php

use App\Enums\BookingPaymentStatus;
use App\Enums\BookingStatus;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_booking_id')->nullable();
            $table->uuid('mentee_booking_session_uuid');
            $table->foreignIdFor(User::class, 'mentee_id');
            $table->foreignIdFor(User::class, 'mentor_id');
            $table->string('status')->default(BookingStatus::PENDING->value);
            $table->string('payment_status')->default(BookingPaymentStatus::UNPAID->value);
            $table->decimal('price');
            $table->dateTime('schedule');
            $table->integer('duration');
            $table->text('meeting_notes')->nullable();
            $table->string('reference_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
