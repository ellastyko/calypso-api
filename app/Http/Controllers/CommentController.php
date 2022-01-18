<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display comments.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response([
                'message' => 'Comment isn`t exist'
            ], 404);
        }
        return $comment;
    }

    /**
     * Update comments
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {

        $comment = Comment::find($id);
        if (!$comment) {
            return response([
                'message' => 'Comment isn`t exist'
            ], 400);
        }

        $user = $this->user();
        if ($user->id != $comment->author && $user->role != 'admin') {
            return response([
                'message' => 'You can`t edit this comment'
            ], 400);
        }
        $fields = $request->validate(['content' => 'required|string']);
        $comment->update(['content' => $fields['content']]);


        return response([
            'message' => 'Comment updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {

        $comment = Comment::find($id);
        if (!$comment) {
            return response([
                'message' => 'Comment isn`t exist'
            ], 404);
        }
        $comment->delete();

        return response([
            'message' => 'Comment deleted'
        ]);
    }
}
