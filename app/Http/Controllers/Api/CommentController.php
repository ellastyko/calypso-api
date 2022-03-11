<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display comment
     *
     * @param CommentService $service
     * @param int $id
     * @return JsonResponse
     */
    public function show(CommentService $service, int $id): JsonResponse
    {
        return $service->show($id);
    }


    /**
     * Update comment
     *
     * @param CommentRequest $request
     * @param CommentService $service
     * @return JsonResponse
     */
    public function store(CommentRequest $request, CommentService $service): JsonResponse
    {
        return $service->store($request->validated());
    }


    /**
     * Update comment
     *
     * @param CommentRequest $request
     * @param CommentService $service
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(CommentRequest $request, CommentService $service, Comment $comment): JsonResponse
    {
        return $service->update($comment, $request->validated());
    }

    /**
     * Destroy comment
     *
     * @param CommentService $service
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(CommentService $service, Comment $comment): JsonResponse
    {
        return $service->destroy($comment);
    }
}
