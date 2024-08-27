<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_responses', function (Blueprint $table) {
            $table->tinyInteger('commentable_id');
            $table->string('commentable_type');
            $table->tinyInteger('user_id');
            $table->integer('notice_id');
            $table->string('text');
            $table->tinyInteger('status');
            $table->id();
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
        Schema::dropIfExists('comment_responses');
    }
}
