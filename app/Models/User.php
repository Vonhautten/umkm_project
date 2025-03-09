<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_user'; // Menyesuaikan dengan nama tabel

    protected $fillable = [
        'nama', 'email', 'password', 'telepon', 'alamat', 'role'
    ];

    protected $hidden = [
        'password',
    ];
}

