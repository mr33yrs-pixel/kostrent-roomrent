<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Security headers applied to every response.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip strict CSP for admin/Filament routes — Filament/Livewire
        // manages its own assets and the public-site CSP breaks them.
        if ($request->is('admin*', 'livewire*')) {
            return $next($request);
        }

        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->remove('X-Powered-By');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: blob: https://*.googleapis.com https://*.gstatic.com; frame-src https://www.google.com; connect-src 'self' https://www.google-analytics.com;");

        // Allow browsers/proxies to cache public pages (5 min browser, 10 min proxy)
        if ($request->isMethod('GET') && !$request->user()) {
            $response->headers->set('Cache-Control', 'public, max-age=300, s-maxage=600');
        }

        return $response;
    }
}
