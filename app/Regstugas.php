<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regstugas extends Model
{
    use SoftDeletes;

    protected $table = "reg_stugas";
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai')->withTrashed();
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan','ttd_stugas');
    }
}
