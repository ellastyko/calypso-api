<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserAvatarFactory extends Factory
{
    /**
     * @var array|string[]
     */
    private array $avatars = [
        '',
        '',
        '',
        '',
        '',
        '',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'path' => $this->avatars[rand(0, 5)],
        ];
    }
}
