<?php

namespace Database\Seeders;

use App\Models\Reaction;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(30)
            ->has(Reaction::factory(20))
            ->create();
    }
}
