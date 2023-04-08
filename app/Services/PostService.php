<?php

namespace App\Services;

use App\Criteria\AddPostStatusCriteria;
use App\Criteria\AddUserPostsCriteria;
use App\Enum\PostStatus;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostService
 */
class PostService
{
    /**
     * @param PostRepository $repository
     */
    public function __construct(protected PostRepository $repository)
    {
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index()
    {
        return $this->repository
            ->pushCriteria(new AddPostStatusCriteria([PostStatus::PUBLISHED]))
            ->all();
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function myPosts()
    {
        return $this->repository
            ->pushCriteria(new AddPostStatusCriteria(PostStatus::all()))
            ->pushCriteria(new AddUserPostsCriteria(Auth::id()))
            ->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        $post = Post::create([
            'title'   => $data['title'],
            'content' => $data['content'],
            'status'  => $data['status'],
            'user_id' => Auth::id(),
        ]);

        foreach ($data['categories_id'] as $categoryId) {
            $post->categories()->attach($categoryId);
        }

        return $post;
    }

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function update(Post $post, array $data): Post
    {
        $post->update($data);
        $post->categories()->sync($data['categories_id']);

        return $post;
    }

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    public function ban(Post $post, array $data): Post
    {
        $post->update([
            'status' => PostStatus::BANNED
        ]);
        $post->ban()->create([
            'message' => $data['message'],
            'user_id' => Auth::id(),
        ]);

        return $post;
    }
}
