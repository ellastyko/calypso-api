<?php

namespace App\Models\traits;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasReactions
{
    /**
     * @return HasMany
     */
    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    /**
     * @return int
     */
    public function likes(): int
    {
        return $this->reactions()->where('type', '=', 1)->count();
    }

    /**
     * @return int
     */
    public function dislikes(): int
    {
        return $this->reactions()->where('type', '=', 0)->count();
    }

    /**
     * @return int
     */
    public function likesTotal(): int
    {
        return $this->likes() - $this->dislikes();
    }
}
