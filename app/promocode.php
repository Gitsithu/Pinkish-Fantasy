<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class promocode extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $table = 'promo_code';
    protected $fillable = ['id','code','start_date','end_date','user_limit'];
}
