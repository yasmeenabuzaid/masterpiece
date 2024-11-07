<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_salons', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('description')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->foreignId('salon_id')->constrained('salons')->onDelete('cascade');
            $table->json('working_days');
            $table->time('opening_hours_start');
            $table->time('opening_hours_end');
            $table->enum('type', ['women', 'men', 'mixed']);
            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_salons');
    }
};

