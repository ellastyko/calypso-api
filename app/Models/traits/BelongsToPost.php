<?php

namespace App\Models\traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToPost
{
    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
