<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
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
            'reaction' => $this->faker->boolean,
            'post_id' => null,
            'comment_id' => null,
            'nested_comment_id' => null,
            'user_id' => $userIds[array_rand($userIds)]
        ];
    }
}
