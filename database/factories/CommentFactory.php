<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        return [
            'content' => $this->faker->realText,
            'post_id' => $postIds[array_rand($postIds)],
            'user_id' => $userIds[array_rand($userIds)]
        ];
    }
}
