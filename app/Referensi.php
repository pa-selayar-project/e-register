<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    protected $table = "tb_referensi";
    protected $guarded = ['id','created_at','updated_at'];
}
