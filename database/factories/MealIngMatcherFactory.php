<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MealIngMatcherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ingredient = Ingredient::all()->pluck('id');
        $meal = Meal::all()->pluck('id')->toArray();


        foreach ($meal as $mealID) {
            return [
                DB::table('food_tags')->insert([
                    'meal_id' => $mealID,
                    'tag_id' => $ingredient->random(),
                ])
            ];
        }
    }
}
