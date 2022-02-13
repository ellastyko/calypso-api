<?php

namespace Database\Factories;

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
        return [
            'content' => $this->faker->realText,
            'post_id' => null,
            'comment_id' => null,
            'user_id' => rand(1, 10)
        ];
    }
}
