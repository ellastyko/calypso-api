<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostController
 * @package Controller
 */
class PostController extends Controller
{
    /**
     * Get posts
     *
     * @param PostService $service
     * @return JsonResponse
     */
    public function index(PostService $service): JsonResponse
    {
        return $service->index();
    }

    /**
     * Store a new post
     *
     * @param PostStoreRequest $request
     * @param PostService $service
     * @return JsonResponse
     */
    public function store(PostStoreRequest $request, PostService $service): JsonResponse
    {
        return $service->store($request->validated());
    }

    /**
     * Show post
     * @param int $id
     * @return PostResource
     */
    public function show(int $id): PostResource
    {
        return new PostResource(Post::findOrFail($id));
    }

    /**
     * Update post
     *
     * @param PostUpdateRequest $request
     * @param PostService $service
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostUpdateRequest $request, PostService $service, Post $post): JsonResponse
    {
        return $service->update($post, $request->validated());
    }

    /**
     * Ban post
     *
     * @param PostUpdateRequest $request
     * @param PostService $service
     * @param Post $post
     * @return JsonResponse
     */
    public function ban(PostUpdateRequest $request, PostService $service, Post $post): JsonResponse
    {
        return new JsonResponse($service->ban($post, $request->validated()));
    }

    /**
     * Destroy post
     *
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
