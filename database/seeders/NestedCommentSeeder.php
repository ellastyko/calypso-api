<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\NestedComment;
use Illuminate\Database\Seeder;

class NestedCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NestedComment::factory(100)
            ->has(Like::factory(20))
            ->create();
    }
}
