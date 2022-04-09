<?php

namespace App\Models;

use App\Events\UserDeleted;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\traits\{HasAvatars, HasComments, HasPosts, HasRoles};
use Laravel\Scout\Searchable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User
 * @package Authenticatable
 */
class User extends Authenticatable implements MustVerifyEmail, Transformable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasAvatars;
    use HasPosts;
    use HasComments;
    use Searchable;
    use TransformableTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
        ];
    }

    /**
     * @return mixed
     */
    public static function current(): mixed
    {
        return app(Guard::class)->user();
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => UserDeleted::class,
    ];

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return ucfirst($this->name) . ' ' . ucfirst($this->surname);
    }
}
