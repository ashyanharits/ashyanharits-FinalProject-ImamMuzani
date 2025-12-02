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
        Schema::table('santri', function (Blueprint $table) {
        $table->unsignedBigInteger('ustadz_id')->nullable()->after('id');

        $table->foreign('ustadz_id')
            ->references('id')
            ->on('ustadz')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santri', function (Blueprint $table) {
        $table->dropForeign(['ustadz_id']);
        $table->dropColumn('ustadz_id');
        });
    }
};
