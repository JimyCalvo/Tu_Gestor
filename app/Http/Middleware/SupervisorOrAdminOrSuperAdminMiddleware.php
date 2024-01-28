<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
class SupervisorOrAdminOrSuperAdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $role_id=auth()->user()->role_id;
        if (auth()->check() && ($role_id == 2 || $role_id == 3)||$role_id==4) {
            return $next($request);
        }
        if(Route::has('login')){
            return redirect()->route('login');
        }
        return response()->json(['message' => 'No autorizado'], 403);
    }
}
