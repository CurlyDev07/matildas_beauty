<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IngredientStock;
use App\FormulationIngredient;
use App\Formulation;

class Ingredients extends Model
{

    protected $guarded = [];

    public function formulationIngredients(){
        return $this->hasMany(FormulationIngredient::class);
    }

    public function stock(){
        return $this->hasOne(IngredientStock::class, 'ingredient_id', 'id');
    }

    public function formulations(){
        return $this->belongsToMany(Formulation::class, 'formulation_ingredients')
                    ->withPivot('percentage')
                    ->withTimestamps();
    }

    public function productionIngredients()
    {
        return $this->hasMany(ProductionIngredient::class, 'ingredient_id', 'id');
    }
}
