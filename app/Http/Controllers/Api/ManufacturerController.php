<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Http\Requests\Manufacturer\StoreManufacturerRequest;
use App\Http\Requests\Manufacturer\UpdateManufacturerRequest;
use Illuminate\Http\Response;
class ManufacturerController extends Controller
{
    public function index()
    {
        return Manufacturer::all();
    }

    public function store(StoreManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->validated());

        return response()->json($manufacturer, 201);
    }

    public function show(Manufacturer $manufacturer)
    {
        if (!$manufacturer) {
            return response()->json(['error' => 'Fabricante no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $manufacturer;
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        if (!$manufacturer) {
            return response()->json(['error' => 'Fabricante no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $manufacturer->update($request->validated());

        return response()->json($manufacturer, 200);
    }

    public function destroy(Manufacturer $manufacturer)
    {
        if (!$manufacturer) {
            return response()->json(['error' => 'Fabricante no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $manufacturer->delete();
        return response()->json(null, 204);
    }
}
