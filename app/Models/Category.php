<?php

namespace App\Models;

use App\Models\traits\HasPosts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package Illuminate\Database\Eloquent\Model
 */
class Category extends Model
{
    use HasFactory;
    use HasPosts;

    protected $dateFormat = 'Y-m-d';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description'
    ];
}
