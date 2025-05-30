<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FormulationIngredients;
use App\Ingredients;

class Formulation extends Model
{
    protected $guarded = [];

    public function formulationIngredients()
    {
        return $this->hasMany(FormulationIngredients::class);
    }

    public function ingredients()
    {
    return $this->belongsToMany(Ingredients::class, 'formulation_ingredients', 'formulation_id', 'ingredient_id')
                ->withPivot('percentage')
                ->withTimestamps();
    }

    
}

