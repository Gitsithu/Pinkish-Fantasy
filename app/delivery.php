<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class delivery extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'delivery';
    protected $fillable = ['id','divison','township','charges'];
}
