<?php

namespace App\Models;

use App\Models\traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAvatar
 */
class UserAvatar extends Model
{
    use HasFactory;
    use BelongsToUser;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'path',
        'created_at'
    ];
}
