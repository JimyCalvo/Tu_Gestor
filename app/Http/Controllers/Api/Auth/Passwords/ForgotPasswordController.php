<?php

namespace App\Http\Controllers\Api\Auth\Passwords;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? response()->json(['message' => 'Enlace de restablecimineto de contraseña fue enviado a su correo electrónico.'], 200)
                    : response()->json(['message' => 'No se puede enviar el enlace de reinicio.'], 400);
    }
}
