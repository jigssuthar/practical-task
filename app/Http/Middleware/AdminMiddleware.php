<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{
    // Check if the user is authenticated and has the 'admin' role
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        // Redirect to the homepage or another route if unauthorized
        return redirect('/')->withErrors(['message' => 'You are not authorized to access this area.']);
    }

    return $next($request); // Continue processing the request if authorized
}

}
