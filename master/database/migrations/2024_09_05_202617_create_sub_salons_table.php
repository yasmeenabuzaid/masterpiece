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
            $table->string('description');
            $table->string('address');
            $table->integer('phone');
            $table->string('image')->nullable();
            $table->foreignId('salons_id')->constrained('salons');
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
