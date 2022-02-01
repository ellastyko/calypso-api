<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostService
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function index(array $data): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.post.index'),
            'data'    => Post::all()
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
        foreach ($data['categoriesId'] as $categoryId) {
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
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.post.shows'),
            'data'    => Post::findOrFail($id)
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
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([
            'message' => trans('messages.category.deleted')
        ], Response::HTTP_NO_CONTENT);
    }
}
