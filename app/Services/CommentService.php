<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /**
     * @param $user
     * @param array $data
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store($user, array $data, int $id): \Illuminate\Http\Response
    {
        return response([
            'message' => trans('messages.comment.created'),
            'comment' => Comment::create([
                'user_id' => $user->id,
                'content' => $data['content'],
                'post_id' => $id
            ])
        ]);
    }
}
