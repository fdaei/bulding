<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string('title');
            $table->text('message');
            $table->boolean('is_close')->default(0);
            $table->boolean('to_admin');
            $table->boolean('is_read')->default(0);
            $table->bigInteger('priority');
            $table->timestamps();
            $table->softDeletes(); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
