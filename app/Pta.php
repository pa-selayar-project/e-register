<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pta extends Model
{
    use SoftDeletes;

    protected $table = "tb_pta_satker";
    protected $guarded = "['id','created_at','updated_at','deleted_at']";
}
