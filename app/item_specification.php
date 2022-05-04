<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class item_specification extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $table = 'items_specification';
    protected $fillable = ['id','items_id','size','color','qty','price','status'];
}