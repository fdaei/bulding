<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('context')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('status')->default(\App\Enums\TypeNoticeEnum::PENDING);
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('state_id');
            $table->date('expire_time')->nullable();
            $table->tinyInteger('expired')->default(0);
            $table->tinyInteger('especial');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
