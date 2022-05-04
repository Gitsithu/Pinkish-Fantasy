<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class profit extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'profit';
    protected $fillable = ['id','min','max','percent'];
}
