<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\IngredientStock;
use App\FormulationIngredient;

class Ingredients extends Model
{

    protected $guarded = [];

    public function formulationIngredients(){
        return $this->hasMany(FormulationIngredient::class);
    }

    public function stock(){
        return $this->hasOne(IngredientStock::class, 'ingredient_id', 'id');
    }
}
