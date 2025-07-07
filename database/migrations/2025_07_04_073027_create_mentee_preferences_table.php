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
        Schema::create('mentee_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('learning_preference');
            $table->string('session_frequency');
            $table->text('learning_goal');
            $table->string('timeline');
            $table->text('challenges')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentee_preferences');
    }
};
