<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NestedCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $commentIds = Comment::pluck('id')->toArray();

        return [
            'content' => $this->faker->realText,
            'comment_id' => $commentIds[array_rand($commentIds)],
            'user_id' => $userIds[array_rand($userIds)]
        ];
    }
}
