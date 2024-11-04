<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToSalonsTable extends Migration
{
    public function up()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
