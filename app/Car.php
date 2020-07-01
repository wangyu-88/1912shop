<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //指定表名
    protected $table = 'shop_car';
    //指定主键
    protected $primaryKey = 'cid';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
    // //黑名单
    // protected $guarded = [];
   
}
