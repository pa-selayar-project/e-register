<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $table = "tb_setting";
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
}
