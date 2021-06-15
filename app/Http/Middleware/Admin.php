<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() == null || Auth::user()->getLevel() != "admin") {
            return response()->view('errors.404', [], 404);
        } elseif (Auth::user()->getLevel() == "admin") {
            return $next($request)
                ->header('Access-Control-Allow-Origin', ['http://localhost', '127.0.0.1', '127.0.0.1:8000', 'http://booksto.tk'])
                ->header('Access-Control-Allow-Methods', '*')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Allow-Headers', 'X-CSRF-Token');;
        } else
            return response()->view('errors.404', [], 404);
    }
}
