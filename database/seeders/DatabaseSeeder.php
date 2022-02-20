<?php

namespace Database\Seeders;

use App\Models\NestedComment;
use App\Models\PostCategory;
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
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            PostSeeder::class,
//            PostCategory::class,
            CommentSeeder::class,
//            NestedComment::class
        ]);
    }
}
