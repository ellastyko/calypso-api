<?php

namespace App\Models;

use App\Models\traits\BelongsToComment;
use App\Models\traits\BelongsToUser;
use App\Models\traits\HasReactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @class NestedComment
 * @package model
 */
class NestedComment extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToComment;
    use HasReactions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'comment_id'
    ];
}
