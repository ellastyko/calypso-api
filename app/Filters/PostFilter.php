<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends Filter
{
    /**
     * @param bool $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function status(bool $status = true): Builder
    {
        return $this->query->where('status', '=', $status);
    }
}
