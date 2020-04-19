<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regsk extends Model
{
    use SoftDeletes;

    protected $table = "reg_sk";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id');
    }
}
