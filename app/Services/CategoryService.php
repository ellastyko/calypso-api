<?php

namespace App\Services;

use App\Models\Category;

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
     * @param $creator
     * @param array $data
     * @return mixed
     */
    public function store($creator, array $data): mixed
    {
        return Category::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $creator->id,
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Category::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return Category::find($id)->fill($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return Category::find($id)->delete();
    }
}
