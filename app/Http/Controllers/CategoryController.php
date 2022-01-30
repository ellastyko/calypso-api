<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\IndexRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

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
    public function __construct()
    {
        //
    }

    /**
     * @param IndexRequest $request
     * @param CategoryService $service
     * @return mixed
     */
    public function index(IndexRequest $request, CategoryService $service) : mixed
    {
        return $service->index($request->validated());
    }


    /**
     * Store a newly created category.
     *
     * @param CategoryStoreRequest $request
     * @param CategoryService $service
     * @return Response
     * @throws AuthorizationException
     */
    public function store(CategoryStoreRequest $request, CategoryService $service): Response
    {
        $this->authorize('store', Category::class);
        return $service->store($request->validated());
    }


    /**
     * Show category
     *
     * @param CategoryService $service
     * @param Category $category
     * @return Response
     */
    public function show(CategoryService $service, Category $category): Response
    {
        return $service->show($category);
    }


    /**
     * Update category
     *
     * @param CategoryUpdateRequest $request
     * @param CategoryService $service
     * @param Category $category
     * @return Response
     * @throws AuthorizationException
     */
    public function update(CategoryUpdateRequest $request, CategoryService $service, Category $category): Response
    {
        $this->authorize('update', $category);
        return $service->update($request->validated(), $category);
    }


    /**
     * Remove category
     *
     * @param CategoryService $service
     * @param Category $category
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(CategoryService $service, Category $category): Response
    {
        $this->authorize('delete', $category);
        return $service->destroy($category);
    }
}
