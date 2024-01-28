<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }
    public function create()
    {
        //$areas=Area::all();
        return view('profiles.create', compact('areas'));
    }


    public function store(StoreProfileRequest $request)
    {
        $validatedData=$request->validated();
        $isPassport = $request->has('is_passport');


        if ($isPassport) {
            $validatedData['passport'] = $validatedData['dni_number'];
            $validatedData['dni'] = null;
        } else {
            $validatedData['dni'] = $validatedData['dni_number'];
            $validatedData['passport'] = null;
        }
        unset($validatedData['dni_number']);
        unset($validatedData['is_passport']);


        $profile = Profile::create($validatedData);


        $data=$request->areas_list;

        $profile->areas()->updateOrCreate([], $data);

        $areas=$profile->areas;

        return response()->json([
            'success' => true,
            'miVariable' => $profile,
            'id' =>$profile->id,
            'data' => $data,
            'areas'=>$areas,
            'message' => 'Operación realizada con éxito.'
        ], Response::HTTP_CREATED);
    }


    public function show(Profile $profile)
    {
        return response()->json($profile);
    }


    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        if (!$profile) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $profile->update($request->validated());
        return response()->json($profile);
    }


    public function destroy(Profile $profile)
    {
        if (!$profile) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $profile->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
