<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormulationIngredients extends Model
{
    public function formulation(){
        return $this->belongsTo(Formulation::class);
    }
    
    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}
