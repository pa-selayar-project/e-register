<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePejabatPtaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pejabat_pta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pta_id');
            $table->string('ketua');
            $table->string('wakil_ketua');
            $table->string('plh_ketua');
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
        Schema::dropIfExists('tb_pejabat_pta');
    }
}
