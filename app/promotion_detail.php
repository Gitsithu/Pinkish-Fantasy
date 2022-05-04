<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class promotion_detail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $table = 'promotion_detail';
    protected $fillable = ['id','p_id','product_id','status'];
}
