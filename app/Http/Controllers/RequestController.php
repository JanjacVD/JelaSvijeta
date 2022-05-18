<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Meal;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Lang;

use function PHPUnit\Framework\isEmpty;

class RequestController extends Controller
{
    public function fetchRequest(Request $request)
    {
        $request->validate([
            'per_page' => 'integer',
            'page' => 'integer',
            'category' => 'integer',
            'tags.*' => 'integer',
            'with' => 'array',
            'with.*' => 'string',
            'lang' => 'required|string',
            'diff_time' => 'numeric',
        ]);
        $with = $request->with;
        $category = $request->category;
        $tags = $request->tags;
        $lang = Lang::where('lang', $request->lang)->firstOrFail();
        $meals = $lang->hasMeals;
        $allMeals = Meal::all();
        if($with != null){
            if(in_array('tags', $with)){
                $returnedTags = Tag::all();
            }
            if(in_array('category', $with)){
                $returnedCategory = $category;
            }
            if(in_array('ingredients', $with)){
                $returnedIngredients = Ingredient::all();
            }
        }
        if($category != 0){
            $category = Category::findOrFail($category);
            $filteredByCategory = $meals->where('category_id', $category->id);
        }
        else{
            $filteredByCategory = $meals;
        }
        if($tags != null){
            foreach($filteredByCategory as $meal){
            $meals=$meal->hasTags->pluck('pivot');
            $filteredByTags = $meals->whereIn('tag_id', $tags);
            foreach($filteredByTags as $filtered)
            {
                print($filtered->meal_id);
                $returnedMeals = Meal::all()->whereIn('id', $filtered->meal_id);
                foreach($returnedMeals as $a){
                }
            }
        }
    }
        else{
            $filteredByTags = $filteredByCategory;
        }
    }
}
