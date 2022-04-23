<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::user() && Auth::user()->role_id == 1) {
             if (Auth::user()->status != 1) {
                Auth::logout();
                return redirect()->route('login');
            }
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
