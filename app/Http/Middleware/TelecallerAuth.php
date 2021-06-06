<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class TelecallerAuth
{

    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == "Telecaller"){
            return $next($request);
        }else{
            return redirect('admin');
        }
    }
}
