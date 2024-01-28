<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Models\ItemHistory;
use App\Models\Profile;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\Profile\StoreProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $role = $request->user()->role_id;
        $id_auth = $request->user()->id;
        if ($role == 2) {
            $users = User::with('profile.areas')->where('role_id', 1)->where('id', '!=', $id_auth)->get();
            return response()->json($users);
        } else if ($role == 3) {
            $users = User::with('profile.areas')->whereIn('role_id', [1, 2])->where('id', '!=', $id_auth)->get();
            return response()->json($users);
        } else if ($role == 4) {
            $users = User::with('profile.areas')->whereIn('role_id', [1, 2, 3])->where('id', '!=', $id_auth)->get();
            return response()->json($users);
        }

        return response()->json(['error' => 'No tienes permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
    }


    public function store(StoreUserRequest $userRequest)
    {
        $validatedUser = $userRequest->validated();
        $validatedUser['password'] = Hash::make($validatedUser['password']);
        $validatedUser['email_verified_at'] = now();
        $user = User::create($validatedUser);


        return response()->json($user, 201);
    }


    public function show(string $id, Request $request)
    {
        $role = $request->user()->role_id;
        $id_auth = $request->user()->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        } else {
            if ($id_auth == $id) {
                return response()->json(['error' => 'La información  solicitada se sobrepone con los datos del usuario autenticado'], Response::HTTP_FORBIDDEN);
            } else {
                $role_id = $user->role_id;
            }
        }

        if ($role_id && ($role_id < $role)) {
            if ($role == 2) {
                $user = User::with('profile.areas')->where('id', $id)->where('role_id', $role)->where('id', '!=', $id_auth)->first();

            } else if ($role == 3) {

                $user = User::with('profile.areas')->where('id', $id)->whereIn('role_id', [1, 2])->where('id', '!=', $id_auth)->first();

            } else if ($role == 4) {
                $user = User::with('profile.areas')->where('id', $id)->whereIn('role_id', [1, 2, 3])->where('id', '!=', $id_auth)->first();

            } else {
                return response()->json(['error' => 'No tienes permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json(['error' => 'No tiene los permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
        }
        return response()->json($user);
    }




    public function update( Request $request, string $id, UpdateUserRequest $updateRequest,)
    {

        $role = $request->user()->role_id;
        $id_auth = $request->user()->id;
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        if ($id_auth == $id) {
            return response()->json(['error' => 'La operación solicitada se sobrepone con los datos del usuario autenticado'], Response::HTTP_FORBIDDEN);
        }

        $role_id = $user->role_id;

        if ($role_id && ($role_id < $role)) {
            if ($role == 2) {
                $user = User::where('id', $id)->where('role_id', $role)->where('id', '!=', $id_auth)->first();
            } else if ($role == 3) {
                $user = User::where('id', $id)->whereIn('role_id', [1, 2])->where('id', '!=', $id_auth)->first();
            } else if ($role == 4) {
                $user = User::where('id', $id)->whereIn('role_id', [1, 2, 3])->where('id', '!=', $id_auth)->first();
            } else {
                return response()->json(['error' => 'No tienes permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json(['error' => 'No tiene los permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
        }

        $validatedUser = $updateRequest->validated();
        $validatedUser['password'] = Hash::make($validatedUser['password']);
        $user->update($validatedUser);
        return response()->json($user);
    }

    public function destroy(string $id, Request $request)
    {
        $role = $request->user()->role_id;
        $id_auth = $request->user()->id;
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        if ($id_auth == $id) {
            return response()->json(['error' => 'La operación solicitada se sobrepone con los datos del usuario autenticado'], Response::HTTP_FORBIDDEN);
        }

        $role_id = $user->role_id;

        if ($role_id && ($role_id < $role)) {
            if ($role == 2) {
                $user = User::where('id', $id)->where('role_id', $role)->where('id', '!=', $id_auth)->first();
            } else if ($role == 3) {
                $user = User::where('id', $id)->whereIn('role_id', [1, 2])->where('id', '!=', $id_auth)->first();
            } else if ($role == 4) {
                $user = User::where('id', $id)->whereIn('role_id', [1, 2, 3])->where('id', '!=', $id_auth)->first();
            } else {
                return response()->json(['error' => 'No tienes permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json(['error' => 'No tiene los permisos para realizar esta acción'], Response::HTTP_FORBIDDEN);
        }
        ItemHistory::where('responsible_id', $user->id)->update(['responsible_id' => null]);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

}
