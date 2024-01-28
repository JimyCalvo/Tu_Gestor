<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->profile) {

            if (Route::has('profile.create')) {
                return redirect()->route('profile.create');
            } else {

                return response()->json([
                    'message' => 'Por favor, crea tu perfil.',
                    'create_profile_url' => route('profile.store', ['user_id' => $user->id]),
                ]);
            }
        }

        return $next($request);
    }
}

