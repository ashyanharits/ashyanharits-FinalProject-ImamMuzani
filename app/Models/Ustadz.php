<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ustadz extends Model
{
    use HasFactory;

     protected $table = 'ustadz';
     protected $fillable = ['user_id', 'nama', 'alamat', 'no_hp'];

     // Relasi ke User
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
