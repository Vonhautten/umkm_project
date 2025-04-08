<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_user')->insert([
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'User',
                'email' => 'tes@gmail.com',
                'password' => bcrypt('tes123'),
                'role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'User',
                'email' => 'tes2@gmail.com',
                'password' => bcrypt('tes456'),
                'role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}