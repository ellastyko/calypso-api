<?php

namespace App\Filters;

class PostFilter extends Filter
{

    public function search(string $text)
    {
        return $this->builder
            ->where('title', 'LIKE', '%'.$text.'%')
            ->orWhere('description', 'LIKE', '%'.$text.'%');
    }

    public function orderBy(string $column, string $dir)
    {
        return $this->builder->orderBy($column, $dir);
    }
}
