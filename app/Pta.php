<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pta extends Model
{
    protected $table = "tb_pta";
    protected $guarded = ['id','created_at','updated_at'];
}
