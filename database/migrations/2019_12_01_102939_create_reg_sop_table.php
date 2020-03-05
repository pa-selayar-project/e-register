<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegSopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_sop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_sop');
            $table->string('no_sop');
            $table->text('desc_sop');
            $table->integer('tgl_sop');
            $table->string('bidang_sop');
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
        Schema::dropIfExists('reg_sop');
    }
}
