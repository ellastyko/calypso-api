<?php

namespace App\Criteria;

use App\Enum\PostStatus;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ActivePostCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class ActivePostCriteriaCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('status', PostStatus::PUBLISHED);
    }
}
