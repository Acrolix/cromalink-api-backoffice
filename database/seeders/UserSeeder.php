<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'johndoe@example.com',
                'password' => 'supersecretPass',
            ],
            [
                'email' => 'roberto@example.com',
                'password' => 'supersecretPass',
            ],
            [
                'email' => 'carlitos@example.com',
                'password' => 'supersecretPass',
            ],
            [
                'email' => 'pepito@example.com',
                'password' => 'supersecretPass',
            ],
            [
                'email' => 'mamon@example.com',
                'password' => 'supersecretPass',
            ]
        ];

        foreach ($users as $user) {
            $user['password'] = bcrypt($user['password']);
            \App\Models\User::create($user);

        }
    }
}
