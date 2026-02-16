<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class is_athlete
{
    /**
     * Handle an incoming request.x
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       

        // If user IS athlete
        if (auth()->check() && auth()->user()->role_id == '5') {
            return $next($request);
        }

        // User is NOT logged in → allow only athlete login page
        return redirect()->guest(route('athlete.login.view'));
    }

}