<?php

namespace App\Models\Filter;

use App\Models\Meal;

class Filter
{
    private $meal;
    public function filter($tags, $category, $with, $lang, $trashed, $timestamp, $results)
    {
        $array = [];
        if ($results != null) {
            $rpp = $results;
        } else {
            $rpp = Meal::withTrashed()->count();
        }
        if ($tags != null && $category != null) {
            if ($trashed == true) {
                $querry = Meal::withTrashed()->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->withCount('hasTags');
            } else {
                 $querry = Meal::withCount('hasTags');
            }
            foreach ($tags as $tag) {
                $querry->whereHas('hasTags', function ($q) use ($tag) {
                    $q->where('tag_id', $tag);
                });
            }
            $this->meal = $querry->paginate($rpp);
            $this->meal = $this->meal->where('category_id', $category)->pluck('id');
        }

        if ($tags != null && $category == null) {
            if ($trashed == true) {
                $querry = Meal::withTrashed()->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->withCount('hasTags');
            } else {
                $querry = Meal::withCount('hasTags');
            }
            foreach ($tags as $tag) {
                $querry->whereHas('hasTags', function ($q) use ($tag) {
                    $q->where('tag_id', $tag);
                });
            }
            $this->meal = $querry->paginate($rpp)->pluck('id');
        } elseif ($category != null && $tags == null) {
            if ($trashed == true) {
                $this->meal = Meal::withTrashed()->where('category_id', $category)->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->paginate($rpp)->pluck('id');
            } else {
                $this->meal = Meal::where('category_id', $category)->paginate($rpp)->pluck('id');
            }
        } else {
            if ($trashed == true) {
                $this->meal = Meal::withTrashed()->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->paginate($rpp)->pluck('id');
            } else {
                $this->meal = Meal::paginate($rpp)->pluck('id');
            }
        }
        foreach ($this->meal as $m) {
            $arrayItem = new ObjectCreator();
            array_push($array, $arrayItem->make($m, $with, $lang, $trashed, $timestamp));
        }
        return $array;
    }
}
