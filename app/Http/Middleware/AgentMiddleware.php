<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check user is logged in AND role is agent
        if (!auth()->check() || auth()->user()->role !== 'agent') {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}