<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSignal extends Model
{
    protected $fillable = [
        'website',
        'session_id',
        'local_session_id',
        'fingerprintjs_visitor_id',
        'fingerprint',
        'full_name',
        'phone_number',
        'promo',
        'fbclid',
        'utm_campaign',
        'utm_content',
        'utm_medium',
        'device_type',
        'user_agent',
        'timestamp',
        'fb_ads_id',
        'ip_address'
    ];
}
