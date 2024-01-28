<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Requests\Inventory\StoreInventoryRequest;
use App\Http\Requests\Inventory\UpdateInventoryRequest;
use Illuminate\Http\Response;
class InventoryController extends Controller
{
    public function index()
    {
        return Inventory::with(['repository', 'responsible'])->get();
    }

    public function store(StoreInventoryRequest $request)
    {
        $inventory = Inventory::create($request->validated());


        return response()->json($inventory, 201);
    }

    public function show(Inventory $inventory)
    {
        if (!$inventory) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $inventory->load(['repository', 'responsible']);
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        if (!$inventory) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $inventory->update($request->validated());

        return response()->json($inventory, 200);
    }

    public function destroy(Inventory $inventory)
    {
        if (!$inventory) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $inventory->delete();

        return response()->json(null, 204);
    }
}
