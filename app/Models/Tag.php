<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function hasMeals()
    {
        return $this->belongsToMany(Meal::class, 'food_tags');
    }

    public function hasTranslations()
    {
        return $this->belongsToMany(Lang::class, 'tag_translations');
    }
}
