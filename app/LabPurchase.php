<?php

namespace App;

use App\LabPurchaseIngredient;
use Illuminate\Database\Eloquent\Model;

class LabPurchase extends Model
{
   protected $guarded = [];

    public function ingredients()
    {
        return $this->hasMany(LabPurchaseIngredient::class);
    }
}
