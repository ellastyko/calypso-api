<?php

namespace App\Models;

use App\Models\traits\BelongsToComment;
use App\Models\traits\BelongsToPost;
use App\Models\traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * @package Model
 */
class Like extends Model
{
    use HasFactory, BelongsToUser, BelongsToPost, BelongsToComment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reaction',
        'post_id',
        'comment_id',
        'user_id',
    ];
}
