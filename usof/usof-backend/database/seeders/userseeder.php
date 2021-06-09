<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login' => 'ella',
            'password' => '111',
            'email' => 'admin@admin.com',
            'name' => 'Adinushka',
            'role' => 'admin'
        ]);
        User::create([
            'login' => 'james',
            'password' => '222',
            'email' => 'usertest@gmail.com',
            'name' => 'Alexandrer',
            'role' => 'user'
        ]);
        User::create([
            'login' => 'tolik',
            'password' => '333',
            'email' => 'vadimsergeev1337@gmail.com',
            'name' => 'Vadim',
            'role' => 'user'
        ]);
    }
}
