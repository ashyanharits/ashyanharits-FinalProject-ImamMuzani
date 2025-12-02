<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';

    // Field yang boleh diisi massal
    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'kelas',
        'no_hp',
        'ustadz_id'
    ];

    // Relasi ke Ustadz
    public function ustadz()
    {
        return $this->belongsTo(Ustadz::class, 'ustadz_id');
    }

    // Relasi ke Hafalan
    public function hafalan()
    {
        return $this->hasMany(Hafalan::class);
    }
}
