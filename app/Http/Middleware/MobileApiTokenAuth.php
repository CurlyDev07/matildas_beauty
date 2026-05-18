<?php

namespace App\Http\Middleware;

use App\MobileApiToken;
use Carbon\Carbon;
use Closure;

class MobileApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $plainToken = $request->bearerToken();

        if (!$plainToken) {
            return response()->json([
                'message' => 'Unauthorized. Missing bearer token.',
            ], 401);
        }

        $tokenHash = hash('sha256', $plainToken);

        $token = MobileApiToken::where('token_hash', $tokenHash)
            ->whereNull('revoked_at')
            ->where('expires_at', '>', Carbon::now())
            ->with('user')
            ->first();

        if (!$token || !$token->user) {
            return response()->json([
                'message' => 'Unauthorized. Invalid or expired token.',
            ], 401);
        }

        $token->update(['last_used_at' => Carbon::now()]);
        $request->attributes->set('mobile_api_token', $token);
        $request->setUserResolver(function () use ($token) {
            return $token->user;
        });

        return $next($request);
    }
}
