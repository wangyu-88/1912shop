<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articel extends Model
{
    protected $table='articel';
    protected $primaryKey='id';
    //不自动添加时间 create_at update_at
    public $timestamps= false;
    //黑名单
    protected $guarded=[];
}
