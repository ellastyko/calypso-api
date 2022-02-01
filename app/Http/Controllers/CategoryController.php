<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\IndexRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Category controller
 */
class CategoryController extends Controller
{
    /**
     * TODO
     * $this->authorizeResource(Category::class, 'category');
     * doesn't work
     */

    /**
     * @param IndexRequest $request
     * @param CategoryService $service
     * @return JsonResponse
     */
    public function index(IndexRequest $request, CategoryService $service): JsonResponse
    {
        return $service->index($request->validated());
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
        return $service->store($request->validated());
    }


    /**
     * Show category
     *
     * @param CategoryService $service
     * @param int $id
     * @return JsonResponse
     */
    public function show(CategoryService $service, int $id): JsonResponse
    {
        return $service->show($id);
    }


    /**
     * Update category
     *
     * @param CategoryUpdateRequest $request
     * @param CategoryService $service
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, CategoryService $service, Category $category): JsonResponse
    {
        return $service->update($request->validated(), $category);
    }


    /**
     * Remove category
     *
     * @param CategoryService $service
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(CategoryService $service, Category $category): JsonResponse
    {
        return $service->destroy($category);
    }
}
