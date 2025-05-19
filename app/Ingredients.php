<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{

    protected $guarded = [];

    public function formulationIngredients(){
        return $this->hasMany(FormulationIngredient::class);
    }
}
