<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulation extends Model
{
    protected $fillable = ['product_name'];

    public function formulationIngredients()
    {
        return $this->hasMany(FormulationIngredient::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'formulation_ingredients')
                    ->withPivot('percentage')
                    ->withTimestamps();
    }
}
