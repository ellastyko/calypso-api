<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Model
{
    use HasFactory;

    public $table = 'post_category';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'category_id'
    ];
}
