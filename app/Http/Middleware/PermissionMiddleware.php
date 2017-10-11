<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            // abort(403);
            return redirect()->route('home')
                             ->with('error_message', 'Usted no está autorizado para acceder a esta área.');
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if (Auth::user()->can($permission)) {
                return $next($request);
            }
        }

        // abort(403);
        return redirect()->route('home')
                         ->with('error_message', 'Usted no está autorizado para acceder a esta área.');
    }
}
