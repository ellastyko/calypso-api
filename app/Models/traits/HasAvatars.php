<?php

namespace App\Models\traits;

use App\Models\UserAvatar;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasAvatars
{
    /**
     * @return HasMany
     */
    public function avatars(): HasMany
    {
        return $this->hasMany(UserAvatar::class);
    }
}
