<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hafalan', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('santri_id');
    $table->unsignedBigInteger('kelas_id')->nullable();
    $table->unsignedBigInteger('ustadz_id')->nullable();
    $table->string('nama_hafalan');
    $table->enum('status', ['belum_mulai', 'sedang_hafal', 'selesai'])->default('belum_mulai');
    $table->date('tanggal');
    $table->text('catatan_ustadz')->nullable();
    $table->timestamps();

    $table->foreign('santri_id')->references('id')->on('santri')->onDelete('cascade');
    $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
    $table->foreign('ustadz_id')->references('id')->on('ustadz')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hafalan');
    }
};
