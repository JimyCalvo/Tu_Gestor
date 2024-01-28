<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user->load('role');
        $user->load('profile');
        $user->load('items');
        return response()->json([
            'user' => $user,
            'profile' => $user->profile,
            'role' => $user->role->name,
            'items' => $user->items,
        ]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        $user->profile->update($request->all());
        return response()->json($user, 200);
    }
}
