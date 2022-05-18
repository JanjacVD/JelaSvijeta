<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            DB::table('categories')->insert([
                'title_hr' => 'Naslov kategorije na hrvatskom-'.$random.'',
                'title_en' => 'Category title in English-'.$random.'',
                'slug' => 'naslov-kategorije-'.$random.'',
                'created_at' => now(),
                'updated_at' => now()
            ])
        ];
    }
}
