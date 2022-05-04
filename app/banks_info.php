<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class banks_info extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'banks_info';
    protected $fillable = ['id','bank','account_name','account_no','status','updated_by','updated_at'];
}
