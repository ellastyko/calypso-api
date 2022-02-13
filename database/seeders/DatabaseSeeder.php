<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);


        $posts = Post::factory(10);
        $comments = Comment::factory(10);

        User::factory(10)
            ->has($posts)
            ->create();

        $posts->has(Like::factory(20))
            ->has($comments)
            ->create();
    }
}
