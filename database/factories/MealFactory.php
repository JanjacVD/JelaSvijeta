<?php

namespace Database\Factories;

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
        $random = Str::random(5);
        return [
            'slug' => 'naslov-kategorije-'.$random.'',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'category_id' => 1
        ];
    }
}
