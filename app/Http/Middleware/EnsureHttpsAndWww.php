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

        // Ensure HTTPS and "www."
        if ($scheme !== 'https' || substr($host, 0, 4) !== 'www.') {
            // Ensure 'www.' is added to the host
            $newHost = (substr($host, 0, 4) !== 'www.') ? 'www.' . $host : $host;
            $newUrl = 'https://' . $newHost . $request->getRequestUri();

            return redirect()->to($newUrl, 301); // Permanent Redirect
        }

        return $next($request);
    }
}
