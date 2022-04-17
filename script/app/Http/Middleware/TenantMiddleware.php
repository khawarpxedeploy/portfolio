<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
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
        $is_expired  =  Auth::user()->tenant->will_expire >= Carbon::today();
        if (Auth::user() && $is_expired) {
            return $next($request);
        }else{
            return redirect()->route('user.plan.index');
        }
    }
}
