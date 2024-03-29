<?php

namespace App\Http\Middleware;

use Closure;

class SalesAssociatesAccess
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
        if (auth()->user()->isSA()) {
            return $next($request);
        }else{
            return redirect()->route('products.index');
        }
    }
}
