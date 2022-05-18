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
        Schema::create('food_descritpion_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id')->index();
            $table->foreign('meal_id')
                ->references('id')
                ->on('meals')
                ->onDelete('cascade');
            $table->string('translation');
            $table->unsignedBigInteger('lang_id')->index();
            $table->foreign('lang_id')
                ->references('id')
                ->on('langs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_descritpion_translations');
    }
};
