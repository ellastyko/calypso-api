<?php

namespace App\Models;

use App\Models\traits\BelongsToUser;
use App\Models\traits\HasCategories;
use App\Models\traits\HasComments;
use App\Models\traits\HasReactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * @class Post
 * @package Model
 */
class Post extends Model
{
    use HasFactory;
    use HasCategories;
    use HasComments;
    use HasReactions;
    use BelongsToUser; // SoftDeletes
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }


    /**
     * @param Post $post
     * @return mixed
     */
    public function isActive(Post $post): mixed
    {
        return $post->status;
    }
}
