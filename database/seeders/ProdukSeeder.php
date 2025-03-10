<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_produk')->insert([
            'nama_produk' => 'Ajazz AK33',
            'id_kategori' => 1, // Pastikan ID kategori ini ada di database
            'deskripsi' => 'Ajazz AK33 adalah keyboard mekanikal 82 tombol dengan \nlayout compact yang cocok untuk penggunaan gaming dan produktivitas. \nDilengkapi switch Outemu yang responsif, pencahayaan RGB yang bisa dikustomisasi, serta desain ergonomis untuk kenyamanan jangka panjang.',
            'harga' => 450000,
            'stok' => 20,
            'gambar' => null,
        ]);
    }
}
