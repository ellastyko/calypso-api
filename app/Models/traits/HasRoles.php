<?php

namespace App\Models\traits;

use App\Models\User;

trait HasRoles
{
    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === User::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === User::ROLE_USER;
    }
}
