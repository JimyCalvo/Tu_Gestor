<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        if (!$category) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return $category;
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (!$category) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $category->update($request->validated());
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        if (!$category) {
            return response()->json(['error' => 'Ítem no encontrado'], Response::HTTP_NOT_FOUND);
        }
        $category->delete();

        return response()->json(['message'=>'Elemento eliminado'], 204);
    }
}
