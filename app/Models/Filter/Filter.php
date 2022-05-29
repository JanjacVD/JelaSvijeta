<?php

namespace App\Models\Filter;

use App\Models\Meal;

class Filter
{
    private $meal;
    public function filter($tags, $category, $with, $lang)
    {
        $array = [];
        if ($tags != null && $category != null) {
            $querry = Meal::withTrashed()->withCount('hasTags');
            foreach ($tags as $tag) {
                $querry->whereHas('hasTags', function ($q) use ($tag) {
                    $q->where('tag_id', $tag);
                });
            }
            $this->meal = $querry->get();
            $this->meal = $this->meal->where('category_id',$category)->pluck('id');
        }

        elseif ($category != null && $tags = null) {
            $this->meal = Meal::where('category_id',$category)->pluck('id');
        }
        else{
            $this->meal = Meal::all()->pluck('id');
        }
        foreach($this->meal as $meal){
            $arrayItem = new ObjectCreator();
            array_push($array, $arrayItem->make($meal, $with, $lang));
        }
        return $array;
    }
}
