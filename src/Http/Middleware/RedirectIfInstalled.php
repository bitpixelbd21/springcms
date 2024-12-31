<?php

namespace BitPixel\SpringCms\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfInstalled
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
        // If already installed, redirect to admin login page
        if (env('APP_INSTALLED') === true || env('APP_INSTALLED') === 'true') {
            return redirect()->route('riversite.homepage');
        }

        return $next($request);
    }
}
