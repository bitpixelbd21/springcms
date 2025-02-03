<?php

namespace BitPixel\SpringCms\Http\Middleware;

use BitPixel\SpringCms\Models\ApiAccessToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AccessTokenMiddleware
{
    private $rateLimitKey = 'api_rate_limit_';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['message' => 'Access token is required'], Response::HTTP_UNAUTHORIZED);
        }

        $token = str_replace('Bearer ', '', $token); // Remove 'Bearer ' prefix if present

        // Check in cache first
        $isValid = Cache::remember("access_token_{$token}", 3600, function () use ($token) {
            return ApiAccessToken::where('token', $token)->exists();
        });

        if (!$isValid) {
            return response()->json(['message' => 'Invalid access token'], Response::HTTP_UNAUTHORIZED);
        }

        // Rate limiting logic
        $rateLimitKey = $this->rateLimitKey . $token;
        if (RateLimiter::tooManyAttempts($rateLimitKey, 60)) { // 60 requests per minute
            return response()->json(['message' => 'Too many requests'], Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($rateLimitKey, 60); // Store request count for 1 minute

        return $next($request);
    }
}
