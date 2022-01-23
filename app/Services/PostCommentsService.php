<?php

namespace App\Services;

use App\Models\Comment;

class PostCommentsService
{


    public function store($user, $data, $id) {

        $comment = Comment::create([
            'user_id' => $user->id,
            'content' => $data['content'],

        ]);

        return response([
            'message' => trans('messages.comment.created'),
            'comment' => $comment
        ]);
    }
}
