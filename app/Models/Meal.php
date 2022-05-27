<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory, SoftDeletes;


    public function hasCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function hasTags()
    {
        return $this->belongsToMany(Tag::class, 'food_tags');
    }

    public function hasTranslations()
    {
        return $this->belongsToMany(Lang::class, 'meal_translations')->withPivot(['title', 'description']);
    }
}
