<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Check_auth
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == "Admin"){
            return $next($request);
        }else{
            return redirect('admin');
        }
    }
}
