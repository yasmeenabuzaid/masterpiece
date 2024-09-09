<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the right usertype
        if (Auth::check() && (Auth::user()->usertype === "super_admin" || Auth::user()->usertype === "owner")) {
            return $next($request);
        }
        
        // If not authorized, return a 403 Forbidden response or redirect to a proper page
        return response()->view('errors.403', [], 403); // Adjust to your application's error handling
    }
}
