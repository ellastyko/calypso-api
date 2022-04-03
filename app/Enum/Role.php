<?php

namespace App\Enum;

class Role
{
    public const USER = 1;

    public const  ADMIN = 2;

    /**
     * @return int[]
     */
    public static function all(): array
    {
        return [
            Role::USER,
            Role::ADMIN,
        ];
    }
}
