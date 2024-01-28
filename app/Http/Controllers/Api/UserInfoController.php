<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use \App\Http\Requests\UpdateUserInfoRequest;

class UserInfoController extends Controller
{
    public function userInfo(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $userInfo = [
            'user' => [
                'user id' => $user->id,
                'full_name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role->name,
                'profile' => $user->profile,
                'items' => $user->items,
                'areas' => $user->profile->areas()->distinct()->get()->map(function ($area) {
                    return $area->only(['id','name_area', 'address_area']);
                }),

                'repository' => $user->repositories,
                'inventory' => $user->inventory,
            ]
        ];

        return response()->json($userInfo, 200);
    }
    public function update(Request $request, UpdateUserInfoRequest $updateUserInfoRequest)
    {
        $user = $request->user();
        $user->update($updateUserInfoRequest->only(['full_name', 'username', 'email', 'password']));
        $user->profile->update($updateUserInfoRequest->input('profile'));
        $data=$updateUserInfoRequest->areas_list;

        $user->profile->areas()->updateOrCreate([], $data);
        
        return response()->json(['message' => 'Usuario y perfil actualizados con éxito.'],200);
    }
}
