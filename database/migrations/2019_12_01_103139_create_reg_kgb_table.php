<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegKgbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_kgb', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_kgb');
            $table->integer('pegawai');
            $table->string('no_kgb_old');
            $table->integer('tgl_kgb_old');
            $table->integer('gaji_kgb_old');
            $table->integer('masker_kgb_old');
            $table->string('no_kgb_new');
            $table->integer('tgl_kgb_new');
            $table->integer('gaji_kgb_new');
            $table->integer('masker_kgb_new');
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
        Schema::dropIfExists('reg_kgb');
    }
}
