<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNotices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function (Blueprint $table)
        {
            $table->decimal('lat',10,8)->nullable();
            $table->decimal('lng',11,8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notices', function (Blueprint $table)
        {
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
    }
}
