<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use Illuminate\Http\Response;
class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier)
    {
        if (!$supplier) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return $supplier;
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        if (!$supplier) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $supplier->update($request->validated());

        return response()->json($supplier, 200);
    }

    public function destroy(Supplier $supplier)
    {
        if (!$supplier) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $supplier->delete();

        return response()->json(null, 204);
    }
}
