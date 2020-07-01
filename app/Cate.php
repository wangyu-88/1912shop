<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table='cate';
    protected $primaryKey='c_id';
    //不自动添加时间 create_at update_at
    public $timestamps= false;
    //黑名单
    protected $guarded=[];
}
