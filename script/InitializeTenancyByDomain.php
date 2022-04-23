<?php

declare(strict_types=1);

namespace Stancl\Tenancy\Middleware;

use Closure;
use Stancl\Tenancy\Resolvers\DomainTenantResolver;
use Stancl\Tenancy\Tenancy;

class InitializeTenancyByDomain extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var DomainTenantResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, DomainTenantResolver $resolver)
    {
        $this->tenancy = $tenancy;
        $this->resolver = $resolver;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if (filter_protocol(url('/')) == env('APP_PROTOCOLESS_URL')) {
                return redirect(env('APP_URL'));
         }
        return $this->initializeTenancy(
           $request, $next, str_replace('www.', '', $request->getHost())
        );
    }
}
