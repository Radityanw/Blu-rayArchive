<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
{
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admindashboard');
        } else {
            return redirect()->route('memberdashboard');
        }
    }

    return $next($request);
}
}
