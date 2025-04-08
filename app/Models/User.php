<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{   
    use Notifiable;
    use HasFactory;

    protected $table = 'tbl_user'; // Menyesuaikan dengan nama tabel

    protected $fillable = [
        'nama', 'email', 'password', 'telepon', 'alamat', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->hasMany(PesananModel::class, 'id_user');
    }
}

