<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pegawai');
            $table->string('tempat_lahir');
            $table->string('nip');
            $table->string('pangkat');
            $table->string('jabatan');
            $table->text('alamat');
            $table->string('hp');
            $table->integer('sisa_cuti');
            $table->integer('kgb_yad');
            $table->integer('kp_yad');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pegawai');
    }
}
