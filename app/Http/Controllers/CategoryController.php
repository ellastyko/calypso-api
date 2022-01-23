<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\IndexRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * @param IndexRequest $request
     * @return Response
     */
    public function index(IndexRequest $request): Response
    {
        return response(Category::paginate($request->input('paginate')));
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
        return response([
            'message' => trans('messages.category.created'),
            'category' => $service->store(Auth::id(), $request->validated())
        ]);
    }


    /**
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return response([
            'category' => Category::findOrFail($id)
        ]);
    }


    /**
     * @param CategoryUpdateRequest $request
     * @param CategoryService $service
     * @param int $id
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, CategoryService $service, int $id): Response
    {
        return response([
            'message' => trans('category.updated'),
            'category' => $service->update($request->validated(), $id)
        ]);
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
