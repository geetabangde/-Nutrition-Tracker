<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();

            // Child Basic Info
            $table->string('child_code')->unique(); // AW1029
            $table->string('child_name');
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->string('mother_name');
            $table->string('father_name')->nullable();
            $table->text('address')->nullable();
            $table->string('anganwadi_center');
            $table->string('image')->nullable();
            $table->string('nutrition_status')->nullable();
            $table->timestamps();
        });
    }

     public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('child_code');
        });
    }
};
