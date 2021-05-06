<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserHasStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(auth()->user()->store()->count()){
            return redirect()->route('admin.stores.index')->with('msg-warning', 'Você já possui uma loja cadastrada');
        }
        
        return $next($request);
    }
}
