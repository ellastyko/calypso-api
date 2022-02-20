<?php

namespace App\Models;

use App\Models\traits\BelongsToPost;
use App\Models\traits\BelongsToUser;
use App\Models\traits\HasLikes;
use App\Models\traits\HasNestedComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @class Comment
 * @package model
 */
class Comment extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToPost;
    use HasNestedComments;
    use HasLikes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'post_id'
    ];
}
