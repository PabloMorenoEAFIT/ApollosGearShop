<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::user() && Auth::user()->getIsAdmin() == '1') {
            return $next($request);
        } else {
            return redirect()->route('home.index');
        }

        // if (! auth()->check() || ! auth()->user()->is_admin) {
        //     abort(403);  // Forbid access if not admin
        // }

        // return $next($request);
    }
}
