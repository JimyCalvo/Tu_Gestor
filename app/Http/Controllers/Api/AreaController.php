<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Http\Requests\Area\StoreAreaRequest;
use App\Http\Requests\Area\UpdateAreaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AreaController extends Controller
{
    public function index()
    {
        return Area::all();
    }

    public function store(StoreAreaRequest $request)
    {

        $validatedData = $request->validated();
        $area = Area::create( $validatedData);
        return response()->json($area, 201);
    }




    public function show(Area $area)
    {
        if (!$area) {
            return response()->json(['error' => 'Area no encontrada'], Response::HTTP_NOT_FOUND);
        }
        return $area;
    }

    public function update(UpdateAreaRequest $request, Area $area)
    {
        if (!$area) {
            return response()->json(['error' => 'Area no encontrada'], Response::HTTP_NOT_FOUND);
        }
        $area->update($request->validated());

        return response()->json($area, 200);
    }

    public function destroy(Area $area)
    {
        if (!$area) {
            return response()->json(['error' => 'Area no encontrada'], Response::HTTP_NOT_FOUND);
        }
        $area->delete();

        return response()->json(null, 204);
    }
}
