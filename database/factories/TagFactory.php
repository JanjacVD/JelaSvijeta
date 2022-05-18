<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
            'title_hr' => 'Naslov oznake na hrvatskom-'.$random.'',
            'title_en' => 'Tag title in english-'.$random.'',
            'slug' => 'naslov-oznake-'.$random.'',
            'created_at' => now(),
            'update_at' => now()
        ];
    }
}
