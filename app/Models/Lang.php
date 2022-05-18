<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;

    public function hasTags()
    {
        return $this->belongsToMany(Tag::class, 'tag_translations');
    }

    public function hasIngredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_translations');
    }

    public function hasMeals()
    {
        return $this->belongsToMany(Meal::class, 'meal_translations');
    }

    public function hasDescriptions()
    {
        return $this->belongsToMany(Meal::class, 'food_description_translations');
    }
}
