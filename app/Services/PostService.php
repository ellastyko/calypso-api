<?php

namespace App\Services;

use App\Enum\PostStatus;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostService
{
    /**
     * @param PostRepository $repository
     */
    public function __construct(protected PostRepository $repository)
    {
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.post.index'),
            'data'    => $this->repository->all()
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
            'status'  => $data['status'],
            'user_id' => Auth::id(),
        ]);

        foreach ($data['categories_id'] as $categoryId) {
            $post->categories()->attach($categoryId);
        }

        return response()->json([
            'message' => trans('messages.post.store'),
            'data'    => new PostResource($post)
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
