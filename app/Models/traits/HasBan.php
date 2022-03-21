<?php

namespace App\Models\traits;

use App\Models\PostBan;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasBan
{
    /**
     * @return HasOne
     */
    public function ban(): HasOne
    {
        return $this->hasOne(PostBan::class);
    }
}
