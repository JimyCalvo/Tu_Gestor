<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function loginView(Request $request)
    {
        return view("auth.login");
    }
    public function login(LoginRequest $request)
    {

        $loginType = filter_var($request->user_credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$loginType => $request->user_credential, 'password' => $request->password];
        if (!Auth::attempt($credentials)) {
            return response()->json(['errors' => ['login' => 'Credenciales inválidas.']], 422);
        }

        $user = Auth::user();
        if(Config::get('services.email_verification')){
            if (!$user->hasVerifiedEmail()) {
                $url = route('verification.resend', ['id' => $user->id, 'email' => $user->email]);
                return response()->json([
                    'message' => 'Necesitas verificar tu correo electrónico primero',
                    'url_resend' => $url,
                    'method' => 'POST'
                ], 403);

            }
        }


        $token = $user->createToken('auth_token')->plainTextToken;
        $redirectUrl = $this->determineRedirectUrlBasedOnRole($user->role_id);

        return response()->json([
            'message' => 'Login exitoso',
            'redirectUrl' => $redirectUrl,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);

    }
    protected function determineRedirectUrlBasedOnRole($role)
    {
        switch ($role) {
            case 1:
                return 'dashboard';
            case 2:
                return 'supervisor/dashboard';
            case 3:
                return 'admin/dashboard';
            case 4:
                return 'super-admin/dashboard';
            default:
                return 'dashboard';
        }
    }
}






