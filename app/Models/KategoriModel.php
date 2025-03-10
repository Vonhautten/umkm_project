<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_kategori'; // Menyesuaikan dengan nama tabel
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kategori',
    ];

    public function produk()
    {
        return $this->hasMany(ProdukModel::class, 'id_kategori');
    }
}
