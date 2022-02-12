<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class Filter
 */
class Filter
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @var Collection
     */
    protected Collection $functions;

    /**
     * @var array
     *
     * Used to store the name and values for filters
     * computed from fields and values in request parameters
     * or added programmatically.
     * The keys of this array corresponds to methods declared in
     * a subclass of this class.
     */
    protected array $globals;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->functions = new Collection();
        $this->globals = [];
    }

    /**
     * Applies respective filter methods declared in the subclass
     * that correspond to fields in request query parameters.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }
            if (isset($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }
        return $this->builder;
    }

    /**
     * Gets filters from request query parameters.
     *
     * @return array
     */
    public function filters():array
    {
        return array_merge($this->request->all(), $this->globals);
    }

    /**
     * Registers queries for relations.
     *
     * @param \Closure $function
     * @return $this
     */
    protected function defer(\Closure $function): static
    {
        $this->functions->push($function);
        return $this;
    }


    /** Decorates \Illuminate\Database\Eloquent\Model with
     * query results from registered queries
     * for one or more model relations.
     *
     * @param Model $model
     * @return Model
     */
    public function transform(Model $model): Model
    {
        return $this->functions->reduce(function ($model, $function) {
            return $function($model);
        }, $model);
    }

    /**
     * Adds a filter programmatically
     *
     * @param string $name
     * @param string|null $value |null
     * @return $this
     */
    public function add(string $name, string $value = null): Filter
    {
        $this->globals[$name] = $value;
        return $this;
    }

    public function request(): Request
    {
        return $this->request;
    }
}
