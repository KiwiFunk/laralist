<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Prevent page from being embedded in frames (clickjacking protection)
        $response->headers->set('X-Frame-Options', 'DENY');
        
        // Enable XSS protection in browsers
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Only enable CSP in production
        if (app()->environment('production')) {
            // Get the app URL for CSP
            $appUrl = config('app.url', 'https://laralist.vercel.app');
            
            $csp = "default-src 'self'; " .
                   "script-src 'self' 'unsafe-inline' 'unsafe-eval' {$appUrl}; " .
                   "style-src 'self' 'unsafe-inline' {$appUrl}; " .
                   "img-src 'self' data: https:; " .
                   "font-src 'self' https:; " .
                   "connect-src 'self' {$appUrl};";
            
            $response->headers->set('Content-Security-Policy', $csp);
        }
        
        return $response;
    }
}