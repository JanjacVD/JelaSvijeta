<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
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
            'title_hr' => 'Naslov sastojka na hrvatskom-'.$random.'',
            'title_en' => 'Ingredient title in english-'.$random.'',
            'slug' => 'naslov-sastojka-'.$random.'',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
