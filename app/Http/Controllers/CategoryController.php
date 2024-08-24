<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCategoryRequest;
use App\Http\Requests\UpdateCatrgoryRequest;
use App\Http\Resources\CategoryResources;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'categories' => CategoryResources::collection(Category::paginate(5))->response()
                ->getData()
            ]
        ]);
    }

    public function store(NewCategoryRequest $request)
    {

      $category =  Category::query()->create([
            'title' => $request->get('title')
        ]);

        return response()->json([
            'data' => [
                'category' => new CategoryResources($category)
            ]
        ])->setStatusCode(201);
    }

    public function update(UpdateCatrgoryRequest $request ,Category $category)
    {
        $category->update([
            'title' => $request->get('title')
        ]);

        return response()->json([
            'data' => [
                'category' => new CategoryResources($category)
            ]
        ])->setStatusCode(201);
    }

    public function show(Category $category)
    {
        return response()->json([
            'data' => [
                'category' => new CategoryResources($category)
            ]
        ])->setStatusCode(201);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response([
          'data' =>[
              'message' => $category->title. 'successfully Deleted'
          ]
        ]);
    }
}
