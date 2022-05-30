<?php

namespace App\Models\Filter;

use App\Models\Category;
use App\Models\CategoryTranslations;
use App\Models\FoodIngredients;
use App\Models\FoodTags;
use App\Models\IngredientTranslations;
use App\Models\Meal;
use App\Models\MealTranslations;
use App\Models\TagTranslations;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ObjectCreator
{

    public function make($meal, $with, $lang, $trashed, $timestamp)
    {
        $finalArray = [];

        if($trashed == true){
            $food = Meal::withTrashed()->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->where('id', $meal)->first();
        }
        else{
            $food = Meal::where('id', $meal)->first();
        }
        $foodTranslation = MealTranslations::where('lang_id', $lang)->where('meal_id', $meal)->first();

        if ($food->created_at == $food->updated_at && $food->deleted_at == null) {
            $status = "Created";
        } elseif ($food->created_at != $food->updated_at && $food->deleted_at == null) {
            $status = "Updated";
        } elseif ($food->deleted_at != null) {
            $status = "Deleted";
        }
        if ($with != null) {
            $withArray = [];
            if (in_array('category', $with)) {
                $categoryArray = [];
                $category = Category::where('id', $food->category_id)->first();
                $categoryTranslation = CategoryTranslations::where('lang_id', $lang)->where('category_id', $category->id)->first();
                $catI = $category->id;
                $catT = $categoryTranslation->translation;
                $catS = $category->slug;
                array_push($categoryArray, ['id' => $catI, 'title' => $catT, 'slug' => $catS]);
                array_push($withArray, ['category' => $categoryArray]);
            }
            if (in_array('tags', $with)) {
                $tagsArray = [];
                $relatedTags = FoodTags::where('meal_id', $food->id)->get();
                foreach ($relatedTags as $tag) {
                    $tagTranslation = TagTranslations::where('lang_id', $lang)->where('tag_id', $tag->tag_id)->first();
                    $tagI = $tag->id;
                    $tagT = $tagTranslation->translation;
                    $tagS = $tag->slug;
                    array_push($tagsArray, ['id' => $tagI, 'title' => $tagT, 'slug' => $tagS]);
                    array_push($withArray, ['tags' => $tagsArray]);
                }
            }
            if (in_array('ingredients', $with)) {
                $ingredientsArray = [];
                $relatedIngredients = FoodIngredients::where('meal_id', $food->id)->get();
                foreach ($relatedIngredients as $ingredient) {
                    $ingredientTranslation = IngredientTranslations::where('lang_id', $lang)->where('ingredient_id', $ingredient->ingredient_id)->first();
                    $ingI = $ingredient->id;
                    $ingT = $ingredientTranslation->translation;
                    $ingS = $ingredient->slug;
                    array_push($ingredientsArray, ['id' => $ingI, 'title' => $ingT, 'slug' => $ingS]);
                    array_push($withArray, ['ingredients' => $ingredientsArray]);
                }
            }
        }
        $foodT = $foodTranslation->title;
        $foodD = $foodTranslation->description;
        $foodI = $food->id;
        $foodS = $food->slug;
        array_push($finalArray, ['id' => $foodI, 'title' => $foodT, 'description' => $foodD, 'slug' => $foodS, 'status' => $status]);
        if (!empty($with)) {
            array_push($finalArray, $withArray);
        }
        return $finalArray;
    }
}
