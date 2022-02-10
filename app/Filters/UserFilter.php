<?php

namespace App\Filters;

class UserFilter extends Filter
{
    public function length(int $limit)
    {
        return $this->builder->limit($limit);
    }
}
