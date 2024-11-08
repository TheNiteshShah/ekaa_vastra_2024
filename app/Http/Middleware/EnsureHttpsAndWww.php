<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureHttpsAndWww
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
        $host = $request->getHost();
        $scheme = $request->getScheme();

        if ($scheme !== 'https' || strpos($host, 'www.') !== 0) {
            // Redirect to the corrected URL
            $newUrl = 'https://www.' . ltrim($request->getRequestUri(), '/');
            if (strpos($host, 'www.') === 0) {
                $newUrl = "https://$host" . $request->getRequestUri();
            }

            return redirect($newUrl);
        }

        return $next($request);
    }
}
