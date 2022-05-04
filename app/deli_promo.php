<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class deli_promo extends Model
{
	//
	use SoftDeletes;
	protected $dates = ['deleted_at']; 

	protected $table = 'deli_promo';
	protected $fillable = ['id','start_date','end_date','amt'];

}