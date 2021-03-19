<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (in_array($request->user()->id_level, $roles)) {
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
