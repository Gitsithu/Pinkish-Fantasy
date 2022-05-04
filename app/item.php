<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class item extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'items';
    protected $fillable = ['id','item_code','categories_id','countries_id','cargo_fee','profit_id','image_url1','sale_type','status'];

    public static function MainCategoriesBasedItems() {
        return DB::table('items')
            ->select('items.*')
            ->leftJoin('categories','categories.id','items.categories_id')
            ->leftJoin('sub_categories','sub_categories.id','categories.sub_categories_id')
            ->where('items.status',1);
    }

    public static function SubCategoriesBasedItems() {
        return DB::table('items')
            ->select('items.*')
            ->leftJoin('categories','categories.id','items.categories_id')
            ->where('items.status',1);
    }

    public static function SalePrice($id) {
        $data = DB::table('items')
                ->where('items.id',$id)
                ->leftJoin('countries','countries.id','items.countries_id')
                ->select('items.purchase_price','items.countries_id','countries.exchange_rate','items.profit_id','items.additional_charges','items.cargo_fee','items.shipping_fee')
                ->first();
        if($data->profit_id == 1) {
            // Get Profit according to profit min and max
            $check_profits = DB::table('profit')
                            ->where('profit.countries_id',$data->countries_id)
                            ->get();
            foreach($check_profits as $check_profit) {
                if($check_profit->max != 0 || $check_profit->max != NULL) {
                    if($check_profit->min <= $data->purchase_price && $check_profit->max >= $data->purchase_price) {
                        $profit_percent = DB::table('profit')
                                        ->where('profit.id',$check_profit->id)
                                        ->value('profit.percent');
                    }
                } else {
                    if($check_profit->min <= $data->purchase_price) {
                        $profit_percent = DB::table('profit')
                                        ->where('profit.id',$check_profit->id)
                                        ->value('profit.percent');
                    }
                }
            }
            $profit = $data->purchase_price * ($profit_percent/100);
            $mmk_price = ($data->purchase_price + $profit + $data->cargo_fee + $data->shipping_fee) * $data->exchange_rate;
        } else {
            $mmk_price = ($data->purchase_price + $data->cargo_fee + $data->shipping_fee) * $data->exchange_rate;
        }
        $saleprice = (int)round($mmk_price + $data->additional_charges);
        $sub=substr($saleprice,-3,3);
        if($sub == 000 || $sub== 500) {
            $saleprice;
        } elseif($sub < 500) {
            $saleprice = substr_replace($saleprice,500,-3,3);
        } else {
            $saleprice += 1000;
            $minus = substr($saleprice,-3,3);
            $saleprice -= $minus;
        }
        return $saleprice;
    }

    public static function DiscountPrice($data) {
        $item = DB::table('items')
                ->where('items.id',$data['id'])
                ->leftJoin('countries','countries.id','items.countries_id')
                ->select('items.purchase_price','items.countries_id','countries.exchange_rate','items.profit_id','items.additional_charges','items.cargo_fee','items.shipping_fee')
                ->first();
        $promotion = DB::table('promotion')
                    ->where('id',$data['promotion_id'])
                    ->select('promo_amount','promo_percent')
                    ->first();
        if($promotion->promo_amount == null) {
            $discount_price = $item->purchase_price - ($item->purchase_price * ($promotion->promo_percent/100));
            if($item->profit_id == 1) {
                // Get Profit according to profit min and max
                $check_profits = DB::table('profit')
                                ->where('profit.countries_id',$item->countries_id)
                                ->get();
                foreach($check_profits as $check_profit) {
                    if($check_profit->max != 0 || $check_profit->max != NULL) {
                        if($check_profit->min <= $discount_price && $check_profit->max >= $discount_price) {
                            $profit_percent = DB::table('profit')
                                            ->where('profit.id',$check_profit->id)
                                            ->value('profit.percent');
                        }
                    } else {
                        if($check_profit->min <= $discount_price) {
                            $profit_percent = DB::table('profit')
                                            ->where('profit.id',$check_profit->id)
                                            ->value('profit.percent');
                        }
                    }
                }
                $profit = $discount_price * ($profit_percent/100);
                $mmk_price = ($discount_price + $profit + $item->cargo_fee + $item->shipping_fee) * $item->exchange_rate;
            } else {
                $mmk_price = ($discount_price + $item->cargo_fee + $item->shipping_fee) * $item->exchange_rate;
            }
            $discountprice = (int)round($mmk_price + $item->additional_charges);
            $sub=substr($discountprice,-3,3);
            if($sub == 000 || $sub== 500) {
                $discountprice;
            } elseif($sub < 500) {
                $discountprice = substr_replace($discountprice,500,-3,3);
            } else {
                $discountprice += 1000;
                $minus = substr($discountprice,-3,3);
                $discountprice -= $minus;
            }
        } else {
            $discountprice = $promotion->promo_amount;
        }
        return $discountprice;
    }
}
