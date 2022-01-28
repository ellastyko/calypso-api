<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * @param IndexRequest $request
     * @param PostService $service
     * @return Response
     */
    public function index(IndexRequest $request, PostService $service): Response
    {
        return response([
            'message' => trans('messages.post.created'),
            'posts'   => $service->index($request->validated())
        ]);
    }

    /**
     * Store a new post.
     *
     * @param PostStoreRequest $request
     * @param PostService $service
     * @return Response
     */
    public function store(PostStoreRequest $request, PostService $service): Response
    {
        return response([
            'message' => trans('messages.post.created'),
            'post'    => $service->store(Auth::user(), $request->validated())
        ]);
    }

    /**
     * @param PostService $service
     * @param int $id
     * @return Response
     */
    public function show(PostService $service, int $id): Response
    {
        return response([
            'message' => trans('messages.post.show'),
            'post'    => $service->show($id)
        ]);
    }

    /**
     * @param PostUpdateRequest $request
     * @param PostService $service
     * @param int $id
     * @return Response
     */
    public function update(PostUpdateRequest $request, PostService $service, int $id): Response
    {
        return response([
            'message' =>  trans('messages.post.updated'),
            'post'    => $service->update($request->validated(), $id)
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Post::destroy($id);
        return response([
            'message' => trans('messages.post.deleted')
        ]);
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
