<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        if(Auth::user()->owner_type === "App\NormalUser")
        {
            if(Auth::user()->owner->role->role === "admin")
            {
                return $next($request);
            }   
        }

        return abort(403);
    }
}
