<?php

use Illuminate\Http\Request;

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class UserProfileRequest
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
        if ($request->token != Auth::user()->refresh_token) {
            return \redirect()->back();
        }
        return $next($request);
    }
}
