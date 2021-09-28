<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'tb_gaji_rule';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
