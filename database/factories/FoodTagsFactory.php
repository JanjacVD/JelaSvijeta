<?php

namespace Database\Factories;

use App\Models\FoodTags;
use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FoodTagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tag = Tag::all()->pluck('id');
        $meal = Meal::all()->pluck('id')->toArray();


        foreach ($meal as $mealID) {
            FoodTags::create([
                'meal_id' => $mealID,
                'tag_id' => $tag->random(),
            ]);
        }
    }
}
