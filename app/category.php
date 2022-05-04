<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class category extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'categories';
    protected $fillable = ['id','name','sub_categories_id','status'];
}
