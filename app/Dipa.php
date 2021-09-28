<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dipa extends Model
{
    protected $table = 'tb_dipa';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
