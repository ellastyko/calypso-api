<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAvatar;
use Illuminate\Database\Seeder;

/**
 * @class UserSeeder
 * @package Seeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->has(UserAvatar::factory(5))
            ->create();
    }
}
