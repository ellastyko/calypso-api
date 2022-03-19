<?php

namespace App\Models;

use App\Models\traits\BelongsToComment;
use App\Models\traits\BelongsToPost;
use App\Models\traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * @package Model
 */
class Reaction extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToPost;
    use BelongsToComment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'post_id',
        'comment_id',
        'user_id',
    ];
}
