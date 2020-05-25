<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regkgb extends Model
{
    use SoftDeletes;

    protected $table = "reg_kgb";
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
