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
            'reaction' => $this->faker->boolean,
            'post_id' => null,
            'comment_id' => null,
            'user_id' => rand(1, 10)
        ];
    }
}
