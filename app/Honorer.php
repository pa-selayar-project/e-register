<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Honorer extends Model
{
    use SoftDeletes;

    protected $table = "tb_pegawai";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function regsk()
    {
        return $this->belongsTo('App\Regsk', 'obyek');
    }
    
}
