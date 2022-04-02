<?php

namespace App\Enum;

abstract class PostStatus
{
    public const DRAFT     = 1;

    public const PUBLISHED = 2;

    public const DELETED   = 3;

    public const BANNED    = 4;

    public const IN_REVIEW = 5;

    /**
     * @return int[]
     */
    public static function all(): array
    {
        return [
            PostStatus::DRAFT,
            PostStatus::PUBLISHED,
            PostStatus::DELETED,
            PostStatus::BANNED,
            PostStatus::IN_REVIEW,
        ];
    }
}
