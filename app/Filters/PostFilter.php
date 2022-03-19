<?php

namespace App\Filters;

class PostFilter extends Filter
{
    public function search(string $text)
    {
        return $this->query
            ->where('title', 'LIKE', '%' . $text . '%')
            ->orWhere('description', 'LIKE', '%' . $text . '%');
    }

    public function orderBy(string $column, string $dir)
    {
        return $this->query->orderBy($column, $dir);
    }
}
