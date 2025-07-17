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
        Schema::create('mentee_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('current_status');
            $table->text('bio');
            $table->string('current_role')->nullable();
            $table->json('interests')->nullable();
            $table->string('learning_preference')->nullable();
            $table->string('session_frequency')->nullable();
            $table->text('learning_goal')->nullable();
            $table->text('challenges')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentee_profiles');
    }
};
