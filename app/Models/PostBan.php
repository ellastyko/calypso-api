<?php

namespace App\Models;

use App\Models\traits\BelongsToPost;
use App\Models\traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBan extends Model
{
    use HasFactory;
    use BelongsToUser;
    use BelongsToPost;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'message',
        'post_id',
        'user_id'
    ];
}
