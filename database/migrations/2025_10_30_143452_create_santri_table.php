<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                // Nama Santri
            $table->string('alamat')->nullable();  // Alamat
            $table->date('tanggal_lahir')->nullable(); // Tanggal lahir
            $table->string('kelas')->nullable();   // Kelas (diisi manual)
            $table->string('no_hp')->nullable();   // Nomor HP
            $table->timestamps();                  // created_at & updated_at otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('santri');
    }
};
