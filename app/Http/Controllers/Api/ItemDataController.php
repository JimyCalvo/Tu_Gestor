<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ItemData;
use App\Http\Requests\ItemData\StoreItemDataRequest;
use App\Http\Requests\ItemData\UpdateItemDataRequest;
use Illuminate\Http\Response;
class ItemDataController extends Controller
{
    public function index()
    {
        return ItemData::all();
    }

    public function store(StoreItemDataRequest $request)
    {
        $itemData = ItemData::create($request->validated());

        return response()->json($itemData, 201);
    }

    public function show(ItemData $itemData)
    {
        if (!$itemData) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $itemData;
    }

    public function update(UpdateItemDataRequest $request, ItemData $itemData)
    {
        if (!$itemData) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $itemData->update($request->validated());

        return response()->json($itemData, 200);
    }

    public function destroy(ItemData $itemData)
    {
        if (!$itemData) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $itemData->delete();

        return response()->json(null, 204);
    }
}
