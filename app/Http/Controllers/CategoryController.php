<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
    * @return Response
    */
    public function index(): Response
    {
        return response([
            'categories' => Category::paginate(12)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return Response
     */
    public function store(CategoryStoreRequest $request, ): Response
    {
//        Category::create([
//            'title' => $request['title'],
//            'description' => $request['description']
//        ]);
//        return response([
//            'message' => trans('messages.category.created'),
//            'category' =>
//        ]);
    }


    /**
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $category = Category::findOrFail($id);
        return response([
            'category' => $category
        ]);
    }


    /**
     * @param CategoryUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, int $id): Response
    {

        $category = Category::find($id);
        foreach ($request->all() as $key => $value)
            $category->update([$key => $value]);

        return response([
            'message' => trans('category.updated'),
            'category' => $category
        ]);
    }


    /**
     * Remove category
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {

        Category::find($id)->delete();
        return response([
            'message' => trans('messages.category.deleted')
        ]);
    }

}
