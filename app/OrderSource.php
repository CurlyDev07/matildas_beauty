<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSource extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'is_active',
        'color'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationship to orders
    public function orders()
    {
        return $this->hasMany(FbAds::class, 'source_id');
    }

    // Scope for active sources
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}