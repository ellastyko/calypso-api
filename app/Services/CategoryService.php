<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Response;
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
    public function index(array $data): mixed
    {
        if (isset($data['paginate']))
            return Category::paginate($data['paginate']);
        else
            return Category::all();
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
            'category' => $category
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        return response([
            'category' => $category
        ]);
    }

    /**
     * @param array $data
     * @param $category
     * @return Response
     */
    public function update(array $data, $category): Response
    {
//        dd($category);
//        $category = Category::findOrFail($id);

        $category->update($data);
        return response([
            'message' => trans('messages.category.updated'),
            'category' => $category
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
