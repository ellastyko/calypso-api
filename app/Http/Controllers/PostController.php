<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Post::paginate(4);
    }

    /**
     * Store a new post.
     *
     * @param PostStoreRequest $request
     * @return Response
     */
    public function store(PostStoreRequest $request): Response
    {
//        TODO
        $fields['categories'] = json_encode($fields['categories']);

        $user = $this->user();
        $fields['author'] = $user->id;

        $post = Post::create([
            'author' => $fields['author'],
            'title' => $fields['title'],
            'content' => $fields['content'],
            'categories' => $fields['categories']
        ]);
        return response([
            'message' => 'You have created post',
            'post' => $post
        ]);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $post = Post::find($id);
        if (!$post) {
            return response([
                'message' => trans('messages.post.404')
            ], 404);
        }
        return response([
            'message' => trans('messages.post.show'),
            'post' => $post
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {

        return response([
            'message' => 'Edited'
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        if (!Post::find($id)) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }

        $user = $this->user();

        $post = Post::find($id);

        if ($user->id != $post->author) {
            return response([
                'message' => 'You can`t delete this post'
            ], 400);
        }
        Post::destroy($id);
        return response([
            'message' => 'You have deleted post'
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


        $user = $this->user();
        if(!Post::find($id)) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }

            $fields = $request->validate(['content' => 'required|string']);

            $fields['author'] = $user->id;

            $comment = Comment::create([
                'author' => $fields['author'],
                'post-id' => $id,
                'content' => $fields['content']
            ]);

        return response([
            'message' => 'You have created comment',
            'comment' => $comment
        ]);
    }


    public function showComments($id) {


    }
}
