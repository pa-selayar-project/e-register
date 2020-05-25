<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsFromRegKgbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_kgb', function (Blueprint $table) {
            $table->dropColumn('no_kgb_new');
            $table->dropColumn('tgl_kgb_new');
            $table->dropColumn('gaji_kgb_new');
            $table->dropColumn('gaji_kgb_old');
            $table->dropColumn('no_kgb_old');
            $table->dropColumn('tgl_kgb_old');
            $table->dropColumn('masker_kgb_new');
            $table->dropColumn('masker_kgb_old');
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
