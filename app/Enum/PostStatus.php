<?php

namespace App\Enum;

enum PostStatus: int
{
    case DRAFT     = 1;

    case PUBLISHED = 2;

    case DELETED   = 3;

    case BANNED    = 4;

    case REVIEW    = 5;
}
