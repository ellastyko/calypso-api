<?php

namespace App\Models\traits;

use App\Models\NestedComment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNestedComments
{
    /**
     * @return HasMany
     */
    public function nestedComment(): HasMany
    {
        return $this->hasMany(NestedComment::class);
    }
}
