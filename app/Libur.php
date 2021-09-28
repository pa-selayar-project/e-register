<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    protected $table = 'tb_libur';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
