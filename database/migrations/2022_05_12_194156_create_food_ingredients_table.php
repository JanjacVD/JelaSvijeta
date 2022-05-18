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
        Schema::create('food_ingredients', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id')->index();
            $table->foreign('meal_id')
                ->references('id')
                ->on('meals')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ingredient_id')->index();
            $table->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_ingredients');
    }
};
