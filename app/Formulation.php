<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulation extends Model
{
    public function formulationIngredients(){
        return $this->hasMany(FormulationIngredient::class);
    }
}
