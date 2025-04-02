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
        'produk_id',
        'jumlah',
        'total_harga',
        'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id');
    }
}
