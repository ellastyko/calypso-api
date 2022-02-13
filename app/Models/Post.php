<?php

namespace App\Models;

use App\Models\traits\BelongsToUser;
use App\Models\traits\HasCategories;
use App\Models\traits\HasComments;
use App\Models\traits\HasLikes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @class Post
 * @package Model
 */
class Post extends Model
{
    use HasFactory, HasCategories, HasComments, HasLikes, BelongsToUser; // SoftDeletes

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
}
