<?php

namespace Database\Seeders;

use App\Models\FoodTags;
use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meal = Meal::all()->pluck('id');
        $tag = Tag::all()->pluck('id');
        foreach($meal as $mealID){
            FoodTags::create([
                'meal_id' => $mealID,
                'tag_id' => $tag->random()
            ]);
        }
    }
}
