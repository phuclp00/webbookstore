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
        if(Auth::user()==null){
            return response()->view('errors.404', [], 404);
        }
        elseif(Auth::user()->getLevel()=="admin"){
            return $next($request);
          }
        else
            return response()->view('errors.404', [], 404);
    }

}
