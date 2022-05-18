<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function hasMeals()
    {
        return $this->belongsToMany(Meal::class, 'food_ingredients');
    }
    public function hasTranslations()
    {
        return $this->belongsToMany(Lang::class, 'ingredient_translations');
    }
}
