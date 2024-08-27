<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnRemainedDaysToNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->unsignedTinyInteger("remained_days")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('remained_days');

        });
    }
}
