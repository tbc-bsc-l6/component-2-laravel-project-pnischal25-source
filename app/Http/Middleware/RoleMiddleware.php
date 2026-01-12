<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->userRole->role;

        // Allow Admin to access everything (optional, or strict check)
        // Strictly checking for now as per requirement "Admin Section (viewed only by administators)"
        
        if ($userRole === $role) {
            return $next($request);
        }

        // Special case: Old Student might share some views with Student, but requirements say "Old Students ONLY see..."
        // So we probably want strict separation.
        
        abort(403, 'Unauthorized access.');
    }
}
