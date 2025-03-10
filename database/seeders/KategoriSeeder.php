<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_kategori')->insert([
            'nama_kategori' => 'Keyboard',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}