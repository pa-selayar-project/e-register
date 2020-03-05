<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegStugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_stugas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pegawai');
            $table->string('no_stugas');
            $table->integer('tgl_stugas');
            $table->text('menimbang');
            $table->text('dasar');
            $table->text('maksud');
            $table->integer('dipa');
            $table->string('ttd_stugas');
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
        Schema::dropIfExists('reg_stugas');
    }
}
