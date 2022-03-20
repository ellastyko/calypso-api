<?php

namespace App\Models\traits;

use App\Enum\Role;

trait HasRoles
{
    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === Role::USER;
    }
}
