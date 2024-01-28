<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

use Illuminate\Support\Facades\Route;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario invalido'], 404);
        }

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Enlace de verificación no válido'], 401);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Correo electrónico ya verificado']);
        }

        $user->markEmailAsVerified();

        return response()->json(['message' => 'Correo electrónico verificado exitosamente']);
    }

    public function showNotice(Request $request, $id,$username)
    {
        $user = User::where('id', $id)
                ->where('username', $username)
                ->first();
        if ($user) {
            return view('auth.verify-email', ['id' => $id, 'email' => $user->email]);
        } else {
            return response()->json(['message' => 'No autorizado'], 401);
        }
    }


    public function resend(Request $request)
    {

        $user = User::where('id', $request->id)
                ->where('email', $request->email)
                ->first();
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        }

        $user->sendEmailVerificationNotification();
        if(Route::has('verification.notice')){
            return back()->with('message', 'Email de verificación reenviado.');
        }else {
            return response()->json(['message' => 'Email de verificación reenviado']);
        }

    }
}
