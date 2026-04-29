<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    protected $table = 'customer_feedback';

    protected $fillable = [
        'source',
        'message',
        'type',
        'sentiment',
        'category',
        'summary',
        'recommended_action',
        'is_usable_as_testimonial',
        'risk_level',
    ];

    protected $casts = [
        'is_usable_as_testimonial' => 'boolean',
    ];
}
