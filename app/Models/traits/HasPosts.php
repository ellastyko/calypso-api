<?php

namespace App\Models\traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPosts
{
    /**
     * Relations
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relations
     * @return BelongsToMany
     */
    public function categoryPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
