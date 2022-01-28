<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Http\Response;

class CommentService
{
    /**
     * @param $user
     * @param array $data
     * @return Response
     */
    public function store($user, array $data): Response
    {
        return response([
            'message' => trans('messages.comment.created'),
            'comment' => Comment::create([
                'user_id' => $user->id,
                'content' => $data['content'],
                'post_id' => $data['post_id']
            ])
        ]);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        Comment::find($id)->fill($data);

        return response([
            'message' => trans('messages.comment.updated')
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Comment::findOrFail($id)->delete();

        return response([
            'message' => trans('messages.comment.deleted')
        ]);
    }

    public function show(int $id)
    {
        return Comment::findOrFail($id);
    }
}
