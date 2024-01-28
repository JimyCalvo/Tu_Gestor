<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ItemHistory;
use Illuminate\Http\Request;
use App\Http\Requests\ItemHistory\StoreItemHistoryRequest;
use App\Http\Requests\ItemHistory\UpdateItemHistoryRequest;
use Illuminate\Http\Response;
class ItemHistoryController extends Controller
{
    public function index()
    {
        return ItemHistory::all();
    }

    public function store(StoreItemHistoryRequest $request)
    {
        $itemHistory = ItemHistory::create($request->validated());

        return response()->json($itemHistory, 201);
    }

    public function show(ItemHistory $itemHistory)
    {
        if (!$itemHistory) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $itemHistory;
    }

    public function update(UpdateItemHistoryRequest $request, ItemHistory $itemHistory)
    {
        if (!$itemHistory) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $itemHistory->update($request->validated());

        return response()->json($itemHistory, 200);
    }

    public function destroy(ItemHistory $itemHistory)
    {
        if (!$itemHistory) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $itemHistory->delete();
        return response()->json(null, 204);
    }
}
