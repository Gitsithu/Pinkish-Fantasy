<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class about_us extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'about_us';
    protected $fillable = ['id','image','title','author','paragraph1','paragraph2','paragraph3','updated_by','updated_at'];
}
