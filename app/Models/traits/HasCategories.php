<?php

namespace App\Models\traits;

use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasCategories
{
    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }
}
