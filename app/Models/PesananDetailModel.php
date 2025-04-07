<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetailModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_pesanan_detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pesanan',
        'id_produk',
        'jumlah',
        'harga_satuan'
    ];

    // Relasi ke tabel pesanan
    public function pesanan()
    {
        return $this->belongsTo(PesananModel::class, 'id_pesanan');
    }

    // Relasi ke tabel produk
    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id_produk');
    }

    // PesananModel.php
    public function details()
    {
        return $this->hasMany(PesananDetailModel::class, 'id_pesanan');
    }
}