<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table='admin';
    protected $primaryKey='admin_id';
    //不自动添加时间 create_at update_at
    public $timestamps= false;
    //黑名单
    protected $guarded=[];
}
