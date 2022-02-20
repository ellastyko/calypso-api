<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Reaction;
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
            ->has(Reaction::factory(20))
            ->create();
    }
}
