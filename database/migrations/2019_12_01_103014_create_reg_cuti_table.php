<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_cuti', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_cuti');
            $table->integer('tgl_cuti');
            $table->string('id_pgw');
            $table->integer('mulai');
            $table->integer('akhir');
            $table->integer('tahun');
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
        Schema::dropIfExists('reg_cuti');
    }
}
