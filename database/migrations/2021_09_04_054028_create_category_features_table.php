<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type');
            $table->tinyInteger('required')->default(0);
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable();
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
        Schema::dropIfExists('category__features');
    }
}
