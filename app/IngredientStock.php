<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientStock extends Model
{
   protected $fillable = ['ingredient_id', 'total_weight'];
}
