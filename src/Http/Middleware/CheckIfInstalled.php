<?php

namespace BitPixel\SpringCms\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfInstalled
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
        // Check if the application is installed
        if (env('APP_INSTALLED') === 'false' || env('APP_INSTALLED') === null) {
            // Redirect to the install route if not installed
            return redirect()->route('install.index');
        }

        return $next($request);
    }
}
