<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    use HasFactory;

    protected $fillable = [
        'progres_pemeriksaan',
        'tanggal',
        'lampiran',
        'keterangan',
        'status',
        'id_pemeriksaan'
    ];
}
