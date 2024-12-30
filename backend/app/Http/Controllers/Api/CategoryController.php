<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Info(title="My First API", version="0.1")
 */

class CategoryController extends BaseController
{
    // add swagger annotations
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Get all categories",
     *     @OA\Response(response="200", description="List of categories")
     * )
     */
    public function index(Request $request )
    {
        $token = CategoryResource::collection(Category::get());
        return $this->sendResponse($token, 'Categories retrive successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = auth()->user()->categories()->create($request->validated());

        $token = new CategoryResource($category);
        return $this->sendResponse($token, 'Category store successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $token = new CategoryResource($category);
        return $this->sendResponse($token, 'Category show successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $token = new CategoryResource(tap($category)->update($request->validated()));
        return $this->sendResponse($token, 'Category update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse('', 'Category destroy successfully.');
        // $category->delete();
        // return response()->noContent();
    }
}
