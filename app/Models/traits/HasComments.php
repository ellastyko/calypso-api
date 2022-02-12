<?php

namespace App\Models\traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasComments
{
    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
