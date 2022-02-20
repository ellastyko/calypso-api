<?php

namespace Database\Seeders;

use App\Models\Reaction;
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
            ->has(Reaction::factory(20))
            ->create();
    }
}
