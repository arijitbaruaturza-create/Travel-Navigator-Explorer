<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('languages')->nullable();
            $table->string('specialization')->nullable();
            $table->decimal('price_per_day', 10, 2)->default(0.00);
            $table->boolean('availability')->default(true);
            $table->foreignId('destination_id')->nullable()->constrained('destinations')->nullOnDelete();
            $table->text('bio')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};
