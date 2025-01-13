<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheControlMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cache-Control for dynamic content (1 hour cache)
        $response->headers->add([
            'Cache-Control' => 'public, max-age=3600, must-revalidate',
        ]);

        return $response;
    }
}
