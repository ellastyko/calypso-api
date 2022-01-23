<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
    * @return Response
    */
    public function index(): Response
    {
        return response([
            'categories' => Category::paginate(10)
        ]);
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

    /**
     * @param Request $request
     * @return Response
     */
    public function showPostsByCategories(Request $request) : Response {


        return response([

        ]);
    }
}
