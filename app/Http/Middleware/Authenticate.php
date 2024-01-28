<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson() && !route('login')) {
            return response()->json(['message' => 'Requiere inicio de sesión'], 401);
        }

        return $request->expectsJson() ? null : route('login');
    }
}
