<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Database extends Model
{
    use SoftDeletes;

    protected $table = 'tb_database';
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
