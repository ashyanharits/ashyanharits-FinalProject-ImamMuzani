<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal'; // tambahkan ini

    protected $fillable = [
        'kelas_id',
        'ustadz_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ustadz()
    {
        return $this->belongsTo(Ustadz::class);
    }
}
