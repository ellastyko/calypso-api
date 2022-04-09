<?php

namespace App\Models;

use App\Models\traits\BelongsToUser;
use App\Models\traits\HasBan;
use App\Models\traits\HasCategories;
use App\Models\traits\HasComments;
use App\Models\traits\HasReactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Post
 * @package Model
 */
class Post extends Model implements Transformable
{
    use HasFactory;
    use HasCategories;
    use HasComments;
    use HasReactions;
    use BelongsToUser;
    use Searchable;
    use HasBan;
    use SoftDeletes;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];
}
