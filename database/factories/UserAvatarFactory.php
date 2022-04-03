<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAvatarFactory extends Factory
{
    /**
     * @var array|string[]
     */
    private array $avatars = [
        'storage/app/public/avatars/default/1.png',
        'storage/app/public/avatars/default/2.png',
        'storage/app/public/avatars/default/3.png',
        'storage/app/public/avatars/default/4.png',
        'storage/app/public/avatars/default/5.png',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->avatars[rand(0, 4)],
            'created_at' => Carbon::now()
        ];
    }
}
