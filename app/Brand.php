<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table='brand';
    protected $primaryKey='brand_id';
    //不自动添加时间 create_at update_at
    public $timestamps= false;
}
