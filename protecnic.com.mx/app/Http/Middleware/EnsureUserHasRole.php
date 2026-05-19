<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! $user->active) {
            abort(403, 'Acceso denegado.');
        }

        // Admin tiene acceso a todo
        if ($user->isAdmin()) {
            return $next($request);
        }

        if (! empty($roles) && ! $user->hasRole($roles)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
