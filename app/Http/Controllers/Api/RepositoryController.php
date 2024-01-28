<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Http\Requests\Repository\StoreRepositoryRequest;
use App\Http\Requests\Repository\UpdateRepositoryRequest;
use Illuminate\Http\Response;
class RepositoryController extends Controller
{
    public function index()
    {
        return Repository::with(['area', 'guardian'])->get();
    }

    public function store(StoreRepositoryRequest $request)
    {
        $repository = Repository::create($request->validated());
        return response()->json($repository, 201);
    }

    public function show(Repository $repository)
    {
        if (!$repository) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $repository->load(['area', 'guardian']);
    }

    public function update(UpdateRepositoryRequest $request, Repository $repository)
    {
        if (!$repository) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $repository->update($request->validated());
        return response()->json($repository, 200);
    }

    public function destroy(Repository $repository)
    {
        if (!$repository) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $repository->delete();

        return response()->json(null, 204);
    }
}
