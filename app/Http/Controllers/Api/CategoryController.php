<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Category controller
 */
class CategoryController extends Controller
{
    /**
     * @param CategoryService $service
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CategoryService $service): AnonymousResourceCollection
    {
        return CategoryResource::collection($service->index());
    }


    /**
     * Store a newly created category.
     *
     * @param CategoryStoreRequest $request
     * @param CategoryService $service
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request, CategoryService $service): JsonResponse
    {
        return response()->json([
            'message' => trans('created'),
            'data' => $service->store($request->validated())
        ], Response::HTTP_CREATED);
    }


    /**
     * Show category
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(int $id): CategoryResource
    {
        return new CategoryResource(Category::findOrFail($id));
    }


    /**
     * Update category
     *
     * @param CategoryUpdateRequest $request
     * @param CategoryService $service
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, CategoryService $service, int $id): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.category.updated'),
            'data' => $service->update($request->validated(), $id)
        ], Response::HTTP_OK);
    }


    /**
     * Remove category
     *
     * @param CategoryService $service
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(CategoryService $service, int $id): JsonResponse
    {
        $service->destroy($id);
        return response()->json([
            'message' => trans('messages.category.deleted')
        ], Response::HTTP_NO_CONTENT);
    }
}
