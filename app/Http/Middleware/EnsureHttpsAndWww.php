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

        // Check if the scheme is not HTTPS or if the host does not start with 'www.'
        if ($scheme !== 'https' || strpos($host, 'www.') !== 0) {
            // Construct the new URL with 'https://www.'
            $newHost = (strpos($host, 'www.') === 0) ? $host : 'www.' . $host;
            $newUrl = 'https://' . $newHost . $request->getRequestUri();

            return redirect($newUrl, 301); // Permanent redirect
        }

        return $next($request);
    }
}
