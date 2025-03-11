<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_produk';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_produk',
        'id_kategori',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'id_kategori');
    }
}
