<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pejabat extends Model
{
    protected $table = "tb_pejabat_pta";
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function pta()
    {
        return $this->belongsTo('App\Pta');
    }
}
