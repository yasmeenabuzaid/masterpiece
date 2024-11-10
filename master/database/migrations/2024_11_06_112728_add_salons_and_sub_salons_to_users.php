<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // حذف الأعمدة والمفاتيح الأجنبية
            $table->dropForeign(['salon_id']);
            $table->dropColumn('salon_id');

            $table->dropForeign(['sub_salons_id']);
            $table->dropColumn('sub_salons_id');
        });
    }
};
