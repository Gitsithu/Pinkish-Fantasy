<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public $incrementing = false;
    protected $table='orders';
    protected $primaryKey='id';
    protected $fillable=['id','order_date','users_id','customer_name','delivery_address','delivery_id','phone','email','total_quantity','cart_total','delivery_cost','promo_code_id','final_cost','payment_type','bank_id','payment_screenshot','preorder_status','status'];
}
