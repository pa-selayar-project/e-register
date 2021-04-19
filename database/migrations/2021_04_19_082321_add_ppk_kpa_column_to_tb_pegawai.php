<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPpkKpaColumnToTbPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_pegawai', function (Blueprint $table) {
            $table->tinyInteger('kpa')->default(0);
            $table->tinyInteger('ppk')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_pegawai', function (Blueprint $table) {
            //
        });
    }
}
