<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredients;
use App\Formulation;


class FormulationIngredients extends Model
{
    protected $guarded = [];

    public function formulation()
    {
        return $this->belongsTo(Formulation::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class);
    }
}
