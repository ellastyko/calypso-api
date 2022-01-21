<?php

namespace Database\Factories;

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
        return [
            'type' => 1,
            'post_id' => rand(1, 10),
            'comment_id' => rand(1, 10),
            'author' => rand(1, 10)
        ];
    }
}
