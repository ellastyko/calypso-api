<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Category service
 */
class CategoryService
{

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function index(array $data): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.category.index'),
            'data'   => Category::all()
        ], Response::HTTP_OK);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data): JsonResponse
    {
        $category = Category::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => trans('created'),
            'data' => $category
        ], Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json([
            'message' => trans('show'),
            'data' => Category::findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * @param array $data
     * @param $category
     * @return JsonResponse
     */
    public function update(array $data, $category): JsonResponse
    {
        $category->update($data);
        return response()->json([
            'message' => trans('messages.category.updated'),
            'data' => $category
        ], Response::HTTP_OK);
    }

    /**
     * @param $category
     * @return JsonResponse
     */
    public function destroy($category): JsonResponse
    {
        $category->delete();
        return response()->json([
            'message' => trans('messages.category.deleted')
        ], Response::HTTP_NO_CONTENT);
    }
}
