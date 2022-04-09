<?php

namespace App\Repositories;

use App\Criteria\ActivePostCriteriaCriteria;
use App\Models\Post;
use App\Repositories\contracts\PostRepositoryInterface;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface, CacheableInterface
{
    /**
     *
     * @var int
     */
    protected int $cacheMinutes = 90;

    protected array $cacheOnly = ['all'];

    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(ActivePostCriteriaCriteria::class));
    }
}
