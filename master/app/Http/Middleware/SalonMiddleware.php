<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Salon;

class SalonMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->has('salon_id')) {
            $salon = Salon::find($request->get('salon_id'));
            if ($salon) {
                view()->share('salon', $salon);
            }
        }

        return $next($request);
    }
}
