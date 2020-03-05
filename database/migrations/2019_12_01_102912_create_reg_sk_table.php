<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegSkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_sk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_sk');
            $table->string('no_sk');
            $table->text('desc_sk');
            $table->integer('tgl_sk');
            $table->string('bidang_sk');
            $table->string('ttd_sk');
            $table->string('tahun');
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
        Schema::dropIfExists('reg_sk');
    }
}
