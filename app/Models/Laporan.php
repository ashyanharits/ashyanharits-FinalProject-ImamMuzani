<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
     protected $table = 'laporan'; // optional kalau nama tabel standar "laporans"
    
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'penulis',
    ];
}
