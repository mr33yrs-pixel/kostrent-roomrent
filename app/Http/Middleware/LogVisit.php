<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     * Logs visits AFTER the response is sent using afterResponse() —
     * completely non-blocking, no queue worker needed on shared hosting.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only log public GET requests (skip admin, livewire, debugbar, assets)
        if (
            !$request->isMethod('GET') ||
            $request->is('admin*', 'livewire*', '_debugbar*', 'storage*', 'build*', 'favicon*')
        ) {
            return $next($request);
        }

        $response = $next($request);

        // Capture data before closure (Request object may not be available after response)
        $visitData = [
            'ip_address' => $request->ip(),
            'url'        => $request->fullUrl(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'user_id'    => $request->user()?->id,
            'meta'       => ['referer' => $request->header('referer')],
        ];

        // Runs AFTER the HTTP response is delivered — zero blocking latency
        dispatch(function () use ($visitData) {
            try {
                \App\Models\Visit::create($visitData);
            } catch (\Throwable $e) {
                report($e);
            }
        })->afterResponse();

        return $response;
    }
}
