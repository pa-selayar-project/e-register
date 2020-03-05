<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regsop extends Model
{
    use SoftDeletes;

    protected $table = "reg_sop";
    protected $guarded = "['id','created_at','updated_at','deleted_at']";
}
