<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;


class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        if (Config::get('services.email_verification')) {
            $user = User::create($validatedData);
            event(new Registered($user));
            $url = route('verification.resend', ['id' => $user->id, 'email' => $user->email]);
            return response()->json([
                'message' => 'Usuario registrado exitosamente. Por favor revise su correo electrónico para verificar su cuenta.',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'full_name' => $user->full_name,
                ],

                'email_verification' => [
                    'message' => 'Enlace de reenvío de verificación de correo electrónico',
                    'url_resend' => $url,
                    'method' => 'POST'
                ]
            ], 201);

        }
        $validatedData['email_verified_at'] = now();
        $user = User::create($validatedData);
        return response()->json([
            'message' => 'Usuario registrado exitosamente.',
            'redirectUrl' => route('login'),
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'full_name' => $user->full_name,
            ]
        ], 201);

    }
}
