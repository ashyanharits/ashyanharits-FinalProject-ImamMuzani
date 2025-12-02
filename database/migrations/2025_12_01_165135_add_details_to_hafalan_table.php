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
        Schema::table('hafalan', function (Blueprint $table) {
            $table->integer('juz')->nullable()->after('nama_hafalan');
            $table->string('halaman')->nullable()->after('juz');
            $table->integer('total_halaman')->nullable()->after('halaman');
            $table->integer('total_baris')->nullable()->after('total_halaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hafalan', function (Blueprint $table) {
            $table->dropColumn(['juz', 'halaman', 'total_halaman', 'total_baris']);
        });
    }
};
