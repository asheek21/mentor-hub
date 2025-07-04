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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('current_role')->nullable();
            $table->string('current_status')->nullable();
            $table->string('company')->nullable();
            $table->string('years_of_experience')->nullable();
            $table->text('bio');
            $table->json('specialization');
            $table->decimal('hourly_rate')->nullable();
            $table->integer('session_duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
