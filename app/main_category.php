<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class main_category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $table = 'main_categories';
    protected $fillable = ['id','name','status'];
}