<?php

namespace App\Services;

use App\Enum\PostStatus;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostService
{
    /**
     * @param array $request
     * @return JsonResponse
     */
    public function index(array $request): JsonResponse
    {
        $data = Post::filter($request)->get();
        return response()->json([
            'message' => trans('messages.post.index'),
            'data'    => $data
        ]);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data): JsonResponse
    {
        $post = Post::create([
            'title'   => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);
        foreach ($data['categories_id'] as $categoryId) {
            DB::table('posts_categories')->insert([
                'post_id' => $post->id,
                'category_id' => $categoryId
            ]);
        }
        return response()->json([
            'message' => trans('messages.post.store'),
            'data'    => $post
        ]);
    }

    /**
     * @param Post $post
     * @param array $data
     * @return JsonResponse
     */
    public function update(Post $post, array $data): JsonResponse
    {
        $post->update($data);
        return response()->json([
            'message' => trans('messages.post.updated'),
            'data'    => $post
        ], Response::HTTP_OK);
    }

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function ban(Post $post, array $data): Post
    {
        $post->update([
            'status' => PostStatus::BANNED
        ]);
        $post->ban()->create([
            'message' => $data['message'],
            'user_id' => Auth::id(),
        ]);

        return $post;
    }
}
