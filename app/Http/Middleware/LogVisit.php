<?php

namespace App\Http\Middleware;

use App\Jobs\LogVisitJob;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     * Dispatches visit logging to a queued job to avoid blocking the user.
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

        // Dispatch job for asynchronous logging
        LogVisitJob::dispatch([
            'ip_address' => $request->ip(),
            'url' => $request->fullUrl(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'user_id' => $request->user()?->id,
            'meta' => [
                'referer' => $request->header('referer'),
            ],
        ]);

        return $response;
    }
}
