<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            // abort(403);
            return redirect()->route('home')
                             ->with('error_message', 'Usted no está autorizado para acceder a esta área.');
        }

        $role = is_array($role)
            ? $role
            : explode('|', $role);

        if (! Auth::user()->hasAnyRole($role)) {
            // abort(403);
            return redirect()->route('home')
                             ->with('error_message', 'Usted no está autorizado para acceder a esta área.');
        }

        return $next($request);
    }
}
