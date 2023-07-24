<?php

namespace App\Http\Middleware;

use Closure;

class InventoryAccess
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
        if (auth()->user()->isInventory()) {
            return $next($request);
        }else{
            return redirect()->route('products.index');
        }
    }
}
