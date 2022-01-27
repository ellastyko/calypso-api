<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * @param array $data
     * @return void
     */
    public function index(array $data)
    {
        if (isset($data['paginate']))
            return Post::paginate($data['paginate']);
        else
            Post::all();
    }

    /**
     * @param $creator
     * @param array $data
     * @return mixed
     */
    public function store($creator, array $data): mixed
    {
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $creator->id,
        ]);
        foreach ($data['categoriesId'] as $categoryId) {
            DB::table('posts_categories')->insert([
                'post_id' => $post->id,
                'category_id' => $categoryId
            ]);
        }
        return $post;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return Post::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        // Add policy TODO
        return Post::find($id)->fill($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        // Add policy TODO
        return Post::find($id)->delete();
    }
}
