<?php

namespace Database\Factories;

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

        return [
            'content' => $this->faker->realText,
            'comment_id' => null,
            'user_id' => $userIds[array_rand($userIds)]
        ];
    }
}
