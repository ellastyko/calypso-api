<?php

namespace App\Services;

use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Response as response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Category service
 */
class CategoryService
{

    /**
     * @param array $data
     * @return mixed
     */
    public function index(array $data)
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * @param array $data
     * @return Response
     */
    public function store(array $data): Response
    {
        $category = Category::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::id(),
        ]);

        return response([
            'message' => trans('created'),
            'data' => $category
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        return response([
            'message' => trans('show'),
            'data' => $category
        ]);
    }

    /**
     * @param array $data
     * @param $category
     * @return Response
     */
    public function update(array $data, $category): Response
    {
        $category->update($data);
        return response([
            'message' => trans('messages.category.updated'),
            'data' => $category
        ]);
    }

    /**
     * @param $category
     * @return Response
     */
    public function destroy($category): Response
    {
        $category->delete();
        return response([
            'message' => trans('messages.category.deleted')
        ], ResponseAlias::HTTP_NO_CONTENT);
    }
}
