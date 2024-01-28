<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Other;
use App\Http\Requests\Other\StoreOtherRequest;
use App\Http\Requests\Other\UpdateOtherRequest;
use Illuminate\Http\Response;
class OtherController extends Controller
{
    public function index()
    {
        return Other::all();
    }

    public function store(StoreOtherRequest $request)
    {
        $other = Other::create($request->validated());
        return response()->json($other, 201);
    }

    public function show(Other $other)
    {
        if (!$other) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $other;
    }

    public function update(UpdateOtherRequest $request, Other $other)
    {
        if (!$other) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $other->update($request->validated());
        return response()->json($other, 200);
    }

    public function destroy(Other $other)
    {
        if (!$other) {
            return response()->json(['error' => 'Caracteristica unica del item no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $other->delete();
        return response()->json(null, 204);
    }
}
