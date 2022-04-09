<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ActivePostCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class AddPostStatusCriteria implements CriteriaInterface
{
    /**
     * @param array $statuses
     */
    public function __construct(private array $statuses)
    {
    }

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
        return $model->whereIn('status', $this->statuses);
    }
}
