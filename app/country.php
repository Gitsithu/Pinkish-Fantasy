<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class country extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $table = 'countries';
    protected $fillable = ['id','name','exchange_rate','profit_percentage','status'];
}
