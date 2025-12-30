<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = tenant();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        if (!$tenant->active) {
            abort(403, 'Tenant inactive');
        }

        return $next($request);
    }
}
