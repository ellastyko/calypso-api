<?php

namespace App\Models\traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToComment
{
    /**
     * @return BelongsTo
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
