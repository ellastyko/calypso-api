<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'title' => $this->faker->title,
            'content' => $this->faker->realText,
            'user_id' => $userIds[array_rand($userIds)]
        ];
    }
}
