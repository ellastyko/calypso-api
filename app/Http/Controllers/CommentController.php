<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display comment
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return Comment::find($id);
    }


    /**
     * Update comment
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return response([
            'message' => trans('messages.comment.created'),
            'comment' => Comment::create([
                'content' => $request['content'],
                'author' => auth()->user()->id
            ])
        ]);
    }


    /**
     * Update comment
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        Comment::find($id)->update(['content' => $request['content']]);

        return response([
            'message' => trans('messages.comment.updated')
        ]);
    }

    /**
     * Destroy comment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {

        Comment::find($id)->delete();

        return response([
            'message' => trans('messages.comment.deleted')
        ]);
    }
}
