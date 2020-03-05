<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Headmenu extends Model
{
    use SoftDeletes;

    protected $table = "tb_head_menu";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'id');
    }
}
