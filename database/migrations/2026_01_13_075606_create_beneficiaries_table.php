<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                  ->constrained('children')
                  ->cascadeOnDelete();

            $table->date('monitoring_date')->default(now());
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('muac', 5, 2)->nullable();

            $table->boolean('bilateral_pitting_edema')->default(false);
            $table->enum('nutrition_status', ['Normal', 'MAM', 'SAM'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
