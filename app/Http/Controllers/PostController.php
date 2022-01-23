<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Post;
use App\Services\PostCommentsService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Post::paginate(5);
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
            'post' => $service->store(Auth::id(), $request->validated())
        ]);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return response([
            'message' => trans('messages.post.show'),
            'post' => Post::find($id)
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, PostService $service, int $id): Response
    {

        return response([
            'message' =>  trans('messages.post.updated')
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
    public function showPostCategories(int $id) : Response{

        /**
         * TODO
         */
        return response([

        ]);
    }


    // Comments

    /**
     * @param CommentRequest $request
     * @param PostCommentsService $service
     * @param int $id
     * @return Response
     */
    public function storeComment(CommentRequest $request, PostCommentsService $service, int $id): Response
    {
        return response([
            'message' => trans('messages.comment.created'),
            'comment' =>  $service->store(Auth::id(), $request->validated(), $id)
        ]);
    }


    public function showComments($id) {


    }
}
