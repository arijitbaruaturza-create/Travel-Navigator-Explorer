<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name');
            $table->string('category')->nullable(); // Beach, Hill, Island, etc.
            $table->text('description')->nullable();

            // Travel Details
            $table->text('attractions')->nullable(); // Can store comma-separated or JSON
            $table->string('best_time')->nullable();

            // Media
            $table->string('image')->nullable();

            // Location (for future Google Maps)
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // ⭐ Rating (IMPORTANT for filter & sorting)
            $table->decimal('rating', 2, 1)->default(0.0); // e.g., 4.5

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};