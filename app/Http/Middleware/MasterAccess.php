<?php

namespace App\Http\Middleware;

use Closure;

class MasterAccess
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
        if (auth()->user()->isMaster()) {
            return $next($request);
        }else{
            return redirect()->route('products.index');
        }
    }
}
