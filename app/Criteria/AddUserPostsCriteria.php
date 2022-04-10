<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AddUserPostsCriteria
 * @package namespace App\Criteria;
 */
class AddUserPostsCriteria implements CriteriaInterface
{
    /**
     * @param int $id
     */
    public function __construct(private int $id)
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
        return $model->where('user_id', $this->id);
    }
}
