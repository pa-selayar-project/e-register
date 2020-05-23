<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_aplikasi');
            $table->string('logo_besar');
            $table->string('logo_kecil');
            $table->string('versi');
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
        Schema::table('tb_setting', function (Blueprint $table) {
            //
        });
    }
}
