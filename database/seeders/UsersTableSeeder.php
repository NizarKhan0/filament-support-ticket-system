<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],

            [
                'name' => 'Agent',
                'email' => 'agent@demo.com',
                'password' => bcrypt('password'),
                'remember_token' => null
            ],
        ];

        //kalau guna insert,created_at dan updated_at tak akan diisi automatik
        User::insert($users);
    }
}