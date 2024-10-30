<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapIframeToSubSalonsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sub_salons', function (Blueprint $table) {
            $table->text('map_iframe')->nullable(); // إضافة العمود الجديد
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_salons', function (Blueprint $table) {
            $table->dropColumn('map_iframe'); // حذف العمود عند التراجع
        });
    }
}

