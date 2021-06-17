<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\userseeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(userseeder::class);
    }
}
