<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * @param int $creator
     * @param array $data
     * @return mixed
     */
    public function store(int $creator, array $data): mixed
    {
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $creator,
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
     * @param $data
     * @param $id
     * @return bool
     */
    public function update($data, $id): bool
    {
        return Post::find($id)->update($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return Post::find($id)->delete();
    }
}
