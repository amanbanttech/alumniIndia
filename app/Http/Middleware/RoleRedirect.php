<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{

    public function handle($request, Closure $next)
    {

        if (!Auth::check()) {

            return $next($request);
        }

        // Redirect based on user role
        switch (Auth::user()->role_id) {
            case 1:
                return redirect()->route('admin.dashboard');

            case 2:
                return redirect()->route('university.dashboard');

            case 3:
                return redirect()->route('sub-university.dashboard');
            case 4:
                return redirect()->route('mentor.dashboard');
            case 5:
                return redirect()->route('athlete.dashboard');
        }

        // If none matched, continue
        return $next($request);
    }
}
