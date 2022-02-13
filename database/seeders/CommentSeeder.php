<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\NestedComment;
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
            ->has(NestedComment::factory(10))
            ->create();
    }
}
