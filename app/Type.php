<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table='type';
    //指定主键
    protected $primaryKey='type_id';
    //不自动添加时间 create_at update_at
    public $timestamps= false;
    //黑名单
    protected $guarded=[];
}
