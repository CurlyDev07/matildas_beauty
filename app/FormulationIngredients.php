<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormulationIngredients extends Model
{
    protected $fillable = ['formulation_id', 'ingredient_id', 'percentage'];

    public function formulation()
    {
        return $this->belongsTo(Formulation::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
