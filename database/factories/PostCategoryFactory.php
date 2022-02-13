<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postIds = Post::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        return [
            'post_id' => $postIds[array_rand($postIds)],
            'category_id' => $categoryIds[array_rand($categoryIds)],
        ];
    }
}
