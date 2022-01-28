<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display comment
     *
     * @param CommentService $service
     * @param int $id
     * @return Response
     */
    public function show(CommentService $service, int $id): Response
    {
        return $service->show($id);
    }


    /**
     * Update comment
     *
     * @param CommentRequest $request
     * @param CommentService $service
     * @return Response
     */
    public function store(CommentRequest $request, CommentService $service): Response
    {
        return $service->store(Auth::user(), $request->validated());
    }


    /**
     * Update comment
     *
     * @param CommentUpdateRequest $request
     * @param CommentService $service
     * @param int $id
     * @return Response
     */
    public function update(CommentUpdateRequest $request, CommentService $service, int $id): Response
    {
        return $service->update($id, $request->validated());
    }

    /**
     * Destroy comment
     *
     * @param CommentService $service
     * @param int $id
     * @return Response
     */
    public function destroy(CommentService $service, int $id): Response
    {
        return $service->destroy($id);
    }
}
