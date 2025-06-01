<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    public static function boot(){
        
    parent::boot();

    static::creating(function ($production) {
        do {
            $batch = 'M' . strtoupper(Str::random(5));
        } while (self::where('batch_number', $batch)->exists());

        $production->batch_number = $batch;
    });
}
}
