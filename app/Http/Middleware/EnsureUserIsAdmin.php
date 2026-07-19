<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND has the 'admin' role
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // If not, abort with 403 Forbidden or redirect to home
        return abort(403, 'You do not have administrative access.');
    }
}