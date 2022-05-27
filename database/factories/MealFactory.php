<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = Category::all()->pluck('id')->random();
        return [
            'slug' => $this->faker->slug(9),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'category_id' => $category,
        ];
    }
}
