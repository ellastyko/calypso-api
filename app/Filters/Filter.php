<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filter
 */
class Filter
{

    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * Applies respective filter methods declared in the subclass
     * that correspond to fields in request query parameters.
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function apply(Builder $query, array $filters): Builder
    {
        $this->query = $query;

        foreach ($filters as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }
            if (isset($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }
        return $this->query;
    }
}
