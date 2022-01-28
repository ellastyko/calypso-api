<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\IndexRequest;
use App\Services\CategoryService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Category controller
 */
class CategoryController extends Controller
{
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
     */
    public function store(CategoryStoreRequest $request, CategoryService $service): Response
    {
        return $service->store(Auth::user(), $request->validated());
    }


    /**
     * Show category
     *
     * @param CategoryService $service
     * @param int $id
     * @return Response
     */
    public function show(CategoryService $service, int $id): Response
    {
        return $service->show($id);
    }


    /**
     * Update category
     *
     * @param CategoryUpdateRequest $request
     * @param CategoryService $service
     * @param int $id
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, CategoryService $service, int $id): Response
    {
        return $service->update($request->validated(), $id);
    }


    /**
     * Remove category
     *
     * @param CategoryService $service
     * @param int $id
     * @return Response
     */
    public function destroy(CategoryService $service, int $id): Response
    {
        $service->destroy($id);
        return response([
            'message' => trans('messages.category.deleted')
        ]);
    }
}
