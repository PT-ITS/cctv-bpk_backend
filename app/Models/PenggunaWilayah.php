<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaWilayah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengguna',
        'jabatan_pengguna',
        'hp_pengguna',
        'alamat_pengguna',
        'nama_wilayah',
        'alamat_wilayah',
        'user_id',
    ];
}
