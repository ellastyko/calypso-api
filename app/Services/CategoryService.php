<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
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
     * @return Category[]
     */
    public function index(array $data): array
    {
        return Category::all(); // Add filters
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Category::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Category
     */
    public function update(array $data, int $id): Category
    {
        $category = Category::findOrFail($id);
        $category->update($data);

        return $category;
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        Category::findOrFail($id)->delete();
    }
}
