<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jeniscuti extends Model
{
    protected $table = "tb_jeniscuti";
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
