<?php

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
        Schema::create('sub_salons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('description')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->foreignId('salon_id')->constrained('salons')->onDelete('cascade');

            $table->json('working_days')->nullable();
            $table->Time ('opening_hours_start');
            $table->Time ('opening_hours_end');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_salons');
    }
};
