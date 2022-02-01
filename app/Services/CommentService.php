<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Comment service
 */
class CommentService
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.comment.created'),
            'data' => Comment::create([
                'user_id' => Auth::id(),
                'content' => $data['content'],
                'post_id' => $data['post_id']
            ])
        ], 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json([
            'message' => trans('messages.comment.updated'),
            'data'    => Comment::findOrFail($id)
        ]);
    }

    /**
     * @param Comment $comment
     * @param array $data
     * @return JsonResponse
     */
    public function update(Comment $comment, array $data): JsonResponse
    {
        $comment->update($data);

        return response()->json([
            'message' => trans('messages.comment.updated')
        ]);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json([
            'message' => trans('messages.comment.deleted')
        ]);
    }
}
