<?php

namespace App\Filters;

class UserFilter extends Filter
{
    public function search(string $text)
    {
        return $this->query
            ->where('name', 'LIKE', "%$text%")
            ->orWhere('surname', 'LIKE', "%$text%");
    }
}
