<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_SES_ACCESS_KEY_ID'),
        'secret' => env('AWS_SES_SECRET_ACCESS_KEY'),
        'region' => env('AWS_SES_DEFAULT_REGION', 'us-west-2'),
    ],

    'facebook' => [
        'client_id' => config('app.fb_client_id'),
        'client_secret' => config('app.fb_client_secret'),
        'redirect' => config('app.fb_callback_url'),
    ],
    'facebook_capi' => [
        'pixel_id'     => env('FB_PIXEL_ID'),
        'access_token' => env('FB_ACCESS_TOKEN'),
        'currency'     => env('FB_CURRENCY', 'PHP'),
    ],
    'facebook_capi_tallow' => [
        'pixel_id_tallow'     => env('FB_PIXEL_ID_TALLOW'),
        'access_token_tallow' => env('FB_ACCESS_TOKEN_TALLOW'),
        'currency_tallow'     => env('FB_CURRENCY_TALLOW', 'PHP'),
    ],

];