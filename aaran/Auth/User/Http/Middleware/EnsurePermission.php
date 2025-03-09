<?php

namespace Aaran\Auth\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePermission
{
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (!$request->user() || !$request->user()->hasPermission($permission)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
