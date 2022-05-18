<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('meal_id');
            $table->string('title');
            $table->string('description');
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('lang_id')->references('id')->on('langs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_translations');
    }
};
