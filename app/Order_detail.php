<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table='orders_detail';
    protected $primaryKey='id';
    protected $fillable=['order_id','item_id','specification_id','price','promotion_id','quantity','sub_total'];
}
