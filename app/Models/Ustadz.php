<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ustadz extends Model
{
    use HasFactory;

     protected $table = 'ustadz';
     protected $fillable = ['nama', 'alamat', 'no_hp'];
}
