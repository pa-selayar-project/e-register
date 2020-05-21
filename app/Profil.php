<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profil extends Model
{
     use SoftDeletes;

    protected $table = "users";
    protected $guarded = ['id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];
}
