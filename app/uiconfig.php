<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class uiconfig extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'ui_config';
    protected $fillable = ['id','indexname','img_url','updated_by','updated_at'];
}
