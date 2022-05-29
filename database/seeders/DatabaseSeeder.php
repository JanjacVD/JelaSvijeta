<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslations;
use App\Models\FoodTags;
use App\Models\Ingredient;
use App\Models\IngredientTranslations;
use App\Models\Lang;
use App\Models\Meal;
use App\Models\MealTranslations;
use App\Models\Tag;
use App\Models\TagTranslations;
use Database\Factories\MealIngMatcherFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Category::factory()->count(5)->create();
        Meal::factory()->count(30)->create();
        Lang::factory()->count(5)->create();
        Ingredient::factory()->count(10)->create();
        Tag::factory()->count(5)->create();

        $lang = Lang::all()->pluck('id');
        $tag = Tag::all()->pluck('id');

        foreach ($tag as $tagID) {
            foreach ($lang as $langID) {
                TagTranslations::create([
                    'lang_id' => $langID,
                    'tag_id' => $tagID,
                    'translation' => $faker->word,
                ]);
            }
        }

            $meal = Meal::all()->pluck('id');
            foreach ($meal as $mealID) {
                foreach ($lang as $langID) {
                    DB::table('meal_translations')->insert([
                        'lang_id' => $langID,
                        'meal_id' => $mealID,
                        'title' => $faker->word,
                        'description' => $faker->sentence(10),
                    ]);
                }
            }

            $ingredient = Ingredient::all()->pluck('id');
            foreach ($ingredient as $ingredientID) {
                foreach ($lang as $langID) {
                    DB::table('ingredient_translations')->insert([
                        'lang_id' => $langID,
                        'ingredient_id' => $ingredientID,
                        'translation' => $faker->word,
                    ]);
                }
            }

            $category = Category::all()->pluck('id');
            foreach ($category as $categoryID) {
                foreach ($lang as $langID) {
                    DB::table('category_translations')->insert([
                        'lang_id' => $langID,
                        'category_id' => $categoryID,
                        'translation' => $faker->word,
                    ]);
                }
            }
        $this->call(TagSeeder::class);
        $this->call(IngredientSeeder::class);
        //To relate more ingredients to a meal run command: php artisan db:seed --class IngredientSeeder
        //To relate more tags to a meal run command: php artisan db:seed --class TagSeeder 
    }
}
