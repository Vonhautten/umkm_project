<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_pesanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'total_harga',
        'status',
        'alamat',
        'metode_bayar'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'produk_id');
    }

    public function details()
    {
        return $this->hasMany(PesananDetailModel::class, 'id_pesanan');
    }
}