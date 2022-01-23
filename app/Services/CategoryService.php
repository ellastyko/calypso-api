<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryService
{

    /**
     * @param int $creator
     * @param array $data
     * @return mixed
     */
    public function store(int $creator, array $data): mixed
    {
        return Category::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $creator,
        ]);
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     */
    public function update($data, $id): bool
    {
        return Category::find($id)->update($data);
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
