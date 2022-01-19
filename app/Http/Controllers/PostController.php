<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Post::limit(5);
    }

    /**
     * Store a new post.
     *
     * @param PostStoreRequest $request
     * @return Response
     */
    public function store(PostStoreRequest $request): Response
    {

        $post = Post::create([
            'author' => auth()->user()->id,
            'title' => $request['title'],
            'content' => $request['content']
        ]);

        foreach ($request['categoriesID'] as $categoryID) {
            DB::table('posts_categories')->create([
                'post_id' => $post->id,
                'category_id' => $categoryID
            ]);
        }
        return response([
            'message' => trans('messages.post.created'),
            'post' => $post
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
    public function update(Request $request, int $id): Response
    {
        Post::update([]);
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

    /**
     * @param Request $request
     * @return Response
     */
    public function showPostsByCategories(Request $request) : Response {

        /**
         * TODO
         */
        return response([

        ]);
    }


    // Comments
    public function storeComment(Request $request, $id) {

        $comment = Comment::create([
            'author' => $request['author'],
            'content' => $request['content']
        ]);

        return response([
            'message' => trans('messages.comment.created'),
            'comment' => $comment
        ]);
    }


    public function showComments($id) {


    }
}
