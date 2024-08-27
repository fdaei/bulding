<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) { $table->id(); $table->integer('time');
            $table->tinyInteger('notice_type')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('price');
            $table->timestamps();
            $table->softDeletes();
            $table->string('revival')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
