<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table= "users";

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
