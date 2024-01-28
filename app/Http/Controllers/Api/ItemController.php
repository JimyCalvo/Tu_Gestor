<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item; 
use App\Models\User;
use App\Models\ItemHistory;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use Illuminate\Http\Response;
use App\Models\Inventory;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());

        $this->createItemHistory($item, 'CREATED');

        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        if (!$item) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $item;
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        if (!$item) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $item->update($request->validated());

        $this->createItemHistory($item, 'UPDATED');

        return response()->json($item, 200);
    }

    public function destroy(Item $item)
    {
        if (!$item) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $this->createItemHistory($item, 'DELETED');
        $item->delete();
        return response()->json(null, 204);
    }
    private function createItemHistory(Item $item, $operation)
    {
        $user = User::where('id', $item->custody_id)->first();
        $custody_name = $user->full_name;
        $dni = $user->profile->dni;
        $passport = $user->profile->passport;
        $custody_dni = $dni ? $dni : $passport;

        $inventory = Inventory::where('id', $item->inventory_id)->first();
        $responsible_name = $inventory->responsible->full_name;
        $dni_resp = $inventory->responsible->profile->dni;
        $passport_resp = $inventory->responsible->profile->passport;
        $responsible_dni = $dni_resp ? $dni_resp : $passport_resp;

        $itemHistory = new ItemHistory;
        $itemHistory->item_id = $item->id;
        $itemHistory->operation = $operation;
        $itemHistory->responsible_id = $inventory->responsible->id;
        $itemHistory->responsible_name = $responsible_name;
        $itemHistory->responsible_dni = $responsible_dni;
        $itemHistory->custody_id = $user->id;
        $itemHistory->custody_name = $custody_name;
        $itemHistory->custody_dni = $custody_dni;
        $itemHistory->save();
    }

}
