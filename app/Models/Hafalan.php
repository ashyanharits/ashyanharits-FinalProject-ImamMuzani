<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalan';

    protected $fillable = [
        'santri_id',
        'kelas_id',
        'nama_hafalan',
        'juz',
        'halaman',
        'total_halaman',
        'total_baris',
        'ayat', // Tambahkan ini
        'status',
        'tanggal',
        'catatan_ustadz',
        'ustadz_id'
    ];

    public function santri() {
        return $this->belongsTo(Santri::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function ustadz() {
        return $this->belongsTo(Ustadz::class);
    }
}

