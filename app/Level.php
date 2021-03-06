<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $table = "tb_level";
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function daftar()
    {
        return $this->belongsTo('App\Daftar', 'id');
    }
}
