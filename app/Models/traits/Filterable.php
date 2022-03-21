<?php

namespace App\Models\traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $query
     * @param array $request
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $request): Builder
    {
        return app($this->filter)->apply($query, $request);
    }
}
