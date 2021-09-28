<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'tb_template';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
