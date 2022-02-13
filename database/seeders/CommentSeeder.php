<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory(100)
            ->has(Like::factory(20))
            ->create();
    }
}
