<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('ayat')->nullable()->after('nama_hafalan');
        });
        
        // Gunakan Raw SQL untuk mengubah enum ke string (varchar)
        // Ini lebih robust jika doctrine/dbal bermasalah
        DB::statement("ALTER TABLE hafalan MODIFY COLUMN status VARCHAR(255) NOT NULL DEFAULT 'belum_lancar'");
    }

    public function down()
    {
        Schema::table('hafalan', function (Blueprint $table) {
            $table->dropColumn('ayat');
            // Kembalikan ke enum lama jika rollback (opsional, agak ribet kalau data udah masuk yg beda)
            // $table->enum('status', ['belum_mulai', 'sedang_hafal', 'selesai'])->change();
        });
    }
};
