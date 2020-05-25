<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToRegKgbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_kgb', function (Blueprint $table) {
            $table->integer('tgl_kgb');
            $table->integer('gapok_baru');
            $table->string('masa_kerja');
            $table->integer('tmt_kgb');
            $table->string('kgb_lama');
            $table->integer('tgl_kgb_lama');
            $table->integer('gapok_lama');
            $table->string('masa_kerja_lama');
            $table->integer('tmt_kgb_lama');
            $table->string('pejabat_kgb_lama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_kgb', function (Blueprint $table) {
            //
        });
    }
}
