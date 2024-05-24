<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;


class StudentMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('User is authenticated: ' . Auth::user()->name);

        if (Auth::check()) {
            Log::info('User is authenticated: ' . Auth::user()->name);
            // Check if the authenticated user is an admin
            if (Auth::user()) {
                // If user is admin, allow access to the requested route
                return $next($request);
            }
        }
        abort(403);
    }
}
