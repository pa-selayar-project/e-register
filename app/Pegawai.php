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
        return $this->hasOne('App\Regcuti');
    }
    
    public function regsk()
    {
        return $this->belongsTo('App\Regsk', 'obyek');
    }
    
    public function pangkat()
    {
        return $this->belongsTo('App\Pangkat', 'pangkat_id');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'jabatan_id');
    }
}
