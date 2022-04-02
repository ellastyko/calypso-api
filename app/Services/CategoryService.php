<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Category service
 */
class CategoryService extends Service
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        if (!$data = Cache::get('categories')) {
            $data = Category::all();
            Cache::put('categories', $data);
        }

        return $data;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Category::create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'user_id'     => Auth::id(),
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
