<?php

namespace App\Models\traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasLikes
{

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
