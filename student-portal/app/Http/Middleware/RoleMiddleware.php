<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles  Allowed roles (e.g. 'student', 'teacher')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Get the currently authenticated user
        $user = $request->user();

        // If no user is logged in OR user's role is not allowed
        if (!$user || !in_array($user->role, $roles)) {
            // Stop and show 403 Forbidden
            abort(403, 'Unauthorized action.');
        }

        // If role matches, allow request to continue
        return $next($request);
    }
}
