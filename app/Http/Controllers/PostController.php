<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Get posts
     *
     * @param IndexRequest $request
     * @param PostService $service
     * @return JsonResponse
     */
    public function index(IndexRequest $request, PostService $service): JsonResponse
    {
        return $service->index($request->validated());
    }

    /**
     * Store a new post.
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
     * @param PostService $service
     * @param int $id
     * @return JsonResponse
     */
    public function show(PostService $service, int $id): JsonResponse
    {
        return $service->show($id);
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
     * Destroy post
     *
     * @param PostService $service
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(PostService $service, Post $post): JsonResponse
    {
        return $service->destroy($post);
    }


    /**
     * @param int $id
     * @return Response
     */
    public function showCategories(int $id) : Response {
        return Post::findOrFail($id)->categories;
    }


    /**
     * @param CommentRequest $request
     * @param CommentService $service
     * @param int $id
     * @return Response
     */
    public function storeComment(CommentRequest $request, CommentService $service, int $id): Response
    {
        return response([
            'message' => trans('messages.comment.created'),
            'comment' =>  $service->store(Auth::user(), $request->validated(), $id)
        ]);
    }
}
