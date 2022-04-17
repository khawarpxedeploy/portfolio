<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubDomainMiddleware
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

        if (tenant('sub_domain') == 1) {
            if (filter_protocol(url('/')) == env('APP_PROTOCOLESS_URL')) {
                return redirect(env('APP_URL'));
            }
           return $next($request);
        }
       
       die('subdomain modules not supported');
    }
}
