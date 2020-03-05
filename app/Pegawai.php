<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;

    protected $table = "tb_pegawai";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function regcuti()
    {
        return $this->belongsTo('App\Regcuti', 'pegawai_id');
    }
}
