<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LogoutController extends Controller
{

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada con éxito.']);
    }

}
