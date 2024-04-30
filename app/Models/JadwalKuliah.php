<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'mata_kuliah',
        'waktu_mulai',
        'waktu_selesai',
        'ruang',
        'dosen',
        'jumlah_mahasiswa',
    ];
}
