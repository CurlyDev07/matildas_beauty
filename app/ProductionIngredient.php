<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionIngredient extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'production_id', 'ingredient_id', 'product_name', 'product_price_per_grams',
        'product_percentage', 'grams', 'price'
    ];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class, 'ingredient_id', 'id');
    }
}
