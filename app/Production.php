<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($production) {
            $lastBatch = self::orderBy('id', 'desc')->first();

            if ($lastBatch && preg_match('/^M(\d{4})$/', $lastBatch->batch_number, $matches)) {
                $nextNumber = (int) $matches[1] + 1;
            } else {
                $nextNumber = 1;
            }

            $production->batch_number = 'M' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function ingredients(){
        return $this->hasMany(ProductionIngredient::class);
    }
}
