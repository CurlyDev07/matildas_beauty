<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacebookCapiTallow
{
    protected string $pixelId;
    protected string $accessToken;
    protected string $currency;

    
    public function __construct()
    {
        $this->pixelId     = config('services.facebook_capi_tallow.pixel_id_tallow');
        $this->accessToken = config('services.facebook_capi_tallow.access_token_tallow');
        $this->currency    = config('services.facebook_capi_tallow.currency_tallow', 'PHP');
    }

    public function getPixelId(): string
    {
        return $this->pixelId;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }


    public function sendEvent(string $eventName, string $eventId, Request $request, array $data = []): void
    {
        if (!$this->pixelId || !$this->accessToken) {
            return;
        }

        // fbc/fbp cookies from browser
        $fbc = $request->cookie('_fbc');
        $fbp = $request->cookie('_fbp');

        // phone hashing
        $phone = $data['phone'] ?? null;
        $phone = $phone ? preg_replace('/\D/', '', $phone) : null;
        $hashedPhone = $phone ? hash('sha256', $phone) : null;

        $payload = [
            'data' => [[
                'event_name'       => $eventName,
                'event_time'       => time(),
                'event_id'         => $eventId,
                'action_source'    => 'website',
                'event_source_url' => $data['url'] ?? $request->fullUrl(),
                'user_data'        => array_filter([
                    'client_ip_address' => $request->ip(),
                    'client_user_agent' => $request->userAgent(),
                    'ph'                => $hashedPhone,
                    'external_id'       => $data['external_id'] ?? null,
                    'fbc'               => $fbc,
                    'fbp'               => $fbp,
                ]),
                'custom_data'      => [
                    'currency' => $this->currency,
                    'value'    => (float) ($data['value'] ?? 0),
                ],
            ]],
        ];

        $url = "https://graph.facebook.com/v18.0/{$this->pixelId}/events?access_token={$this->accessToken}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

}
