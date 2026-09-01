<?php

namespace App\Http\Middleware;

use Closure;

class MasterOrInventoryAccess
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
        $user = auth()->user();

        if ($user && ($user->isMaster() || $user->isInventory())) {
            return $next($request);
        }

        return redirect()->route('dashboard');
    }
}
