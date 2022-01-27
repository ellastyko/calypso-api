<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
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
     * @param  CommentRequest  $request
     * @return Response
     */
    public function store(CommentRequest $request, CommentService $service): Response
    {
        return response([
            'message' => trans('messages.comment.created'),
            'comment' => $service
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
