<?php

namespace Database\Seeders;

use App\Models\FoodIngredients;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meal = Meal::all()->pluck('id');
        $ingredient = Ingredient::all()->pluck('id');
        foreach($meal as $mealID){
            FoodIngredients::create([
                'meal_id' => $mealID,
                'ingredient_id' => $ingredient->random()
            ]);
        }
    }
}
