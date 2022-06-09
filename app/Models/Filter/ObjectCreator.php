<?php

namespace App\Models\Filter;

use App\Models\Category;
use App\Models\CategoryTranslations;
use App\Models\FoodIngredients;
use App\Models\FoodTags;
use App\Models\Ingredient;
use App\Models\IngredientTranslations;
use App\Models\Meal;
use App\Models\MealTranslations;
use App\Models\Tag;
use App\Models\TagTranslations;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ObjectCreator
{

    public function make($meal, $with, $lang, $trashed, $timestamp)
    {
        if ($trashed == true) {
            $food = Meal::withTrashed()->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->where('id', $meal)->first();
        } else {
            $food = Meal::where('id', $meal)->first();
        }
        $foodTranslation = MealTranslations::where('lang_id', $lang)->where('meal_id', $meal)->first();

        if ($food->created_at == $food->updated_at && $food->deleted_at == null) {
            $status = "Created";
        } elseif ($food->created_at != $food->updated_at && $food->deleted_at == null) {
            $status = "Modified";
        } elseif ($food->deleted_at != null) {
            $status = "Deleted";
        }
        $foodI = $food->id;
        $foodT = $foodTranslation->title;
        $foodD = $foodTranslation->description;
        $foodS = $food->slug;
        $returnable = ['id' => $foodI, 'title' => $foodT, 'description' => $foodD, 'slug' => $foodS, 'status' => $status];

        if ($with != null) {
            $withArray = [];
            if (in_array('category', $with)) {
                $categoryArray = [];
                if ($food->category_id != null) {
                    $category = Category::where('id', $food->category_id)->first();
                    $categoryTranslation = CategoryTranslations::where('lang_id', $lang)->where('category_id', $category->id)->first();
                    $catI = $category->id;
                    $catT = $categoryTranslation->translation;
                    $catS = $category->slug;
                    array_push($categoryArray, ['id' => $catI, 'title' => $catT, 'slug' => $catS]);
                    $returnable['category'] = $categoryArray;
                }
                else{
                    $returnable['category'] = null;
                }
            }
            if (in_array('tags', $with)) {
                $tagsArray = [];
                $relatedTags = FoodTags::where('meal_id', $food->id)->get();
                foreach ($relatedTags as $tag) {
                    $tagReal = Tag::where('id', $tag->tag_id)->first();
                    $tagTranslation = TagTranslations::where('lang_id', $lang)->where('tag_id', $tag->tag_id)->first();
                    $tagI = $tagReal->id;
                    $tagT = $tagTranslation->translation;
                    $tagS = $tagReal->slug;
                    array_push($tagsArray, ['id' => $tagI, 'title' => $tagT, 'slug' => $tagS]);
                }
                $returnable['tags'] = $tagsArray;
            }
            if (in_array('ingredients', $with)) {
                $ingredientsArray = [];
                $relatedIngredients = FoodIngredients::where('meal_id', $food->id)->get();

                foreach ($relatedIngredients as $ingredient) {
                    $ingredientReal = Ingredient::where('id', $ingredient->ingredient_id)->first();
                    $ingredientTranslation = IngredientTranslations::where('lang_id', $lang)->where('ingredient_id', $ingredient->ingredient_id)->first();
                    $ingI = $ingredientReal->id;
                    $ingT = $ingredientTranslation->translation;
                    $ingS = $ingredientReal->slug;
                    array_push($ingredientsArray, ['id' => $ingI, 'title' => $ingT, 'slug' => $ingS]);
                }
                $returnable['ingredients'] = $ingredientsArray;
            }
        }

        return $returnable;
    }
}
