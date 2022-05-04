<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'favourites';
    protected $fillable = ['users_id','item_id'];
}
