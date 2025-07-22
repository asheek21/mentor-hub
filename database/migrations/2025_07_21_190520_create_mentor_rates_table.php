<?php

use App\Models\MentorProfile;
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
        Schema::create('mentor_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MentorProfile::class)->cascadeOnDelete();
            $table->decimal('amount', 8, 2);
            $table->string('currency')->default('inr');
            $table->string('stripe_price_id');
            $table->string('stripe_product_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_rates');
    }
};
