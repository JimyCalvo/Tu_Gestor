<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
class AdminOrSuperAdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $role_id=auth()->user()->role_id;
        if (auth()->check() && ($role_id == 4 || $role_id == 3)) {
            return $next($request);
        }
        if(Route::has('login')){
            return redirect()->route('login');
        }
        return response()->json(['message' => 'No autorizado'], 403);

    }
}
