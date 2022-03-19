<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class Filter
 */
class Filter
{
    /**
     * @var array
     */
    protected array $filters;

    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Applies respective filter methods declared in the subclass
     * that correspond to fields in request query parameters.
     *
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        $this->query = $query;

        foreach ($this->filters as $name => $value) {
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
