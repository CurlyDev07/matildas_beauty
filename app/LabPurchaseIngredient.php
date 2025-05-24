<?php

namespace App;
use App\Ingredients;
use App\LabPurchase;

use Illuminate\Database\Eloquent\Model;

class LabPurchaseIngredient extends Model
{
    protected $guarded = [];

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class);
    }

    public function purchase()
    {
        return $this->belongsTo(LabPurchase::class, 'lab_purchase_id');
    }
}
