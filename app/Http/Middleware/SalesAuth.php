<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SalesAuth
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
        if(Auth::check() && Auth::user()->role == "Sales"){
            return $next($request);
        }elseif(Auth::check() && Auth::user()->role == "Credit"){
            return $next($request);
        }elseif(Auth::check() && Auth::user()->role == "Cibil"){
            return $next($request);
        }elseif(Auth::check() && Auth::user()->role == "Login"){
            return $next($request);
        }else{
            return redirect('admin');
        }
    }
}
