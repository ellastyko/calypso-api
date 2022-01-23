<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * @param int $creator
     * @param array $data
     * @return mixed
     */
    public function store(int $creator, array $data): mixed
    {
        return Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
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
