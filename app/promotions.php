<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class promotions extends Model
{
	//
	use SoftDeletes;
	protected $dates = ['deleted_at']; 

	protected $table = 'promotion';
	protected $fillable = ['id','name','start_date','end_date','product_status'];

	public static function MainCatePromotions() {
		return DB::table('promotion')
			->select('promotion.*')
			->where('promotion.product_status',2)
			->groupBy('promotion.promo_percent')
			->orderBy('promotion.promo_percent','desc')
			->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
			->leftJoin('categories','categories.id','promotion_detail.product_id')
			->leftJoin('sub_categories','sub_categories.id','categories.sub_categories_id')
			->where('promotion.start_date','<=',Carbon::today()->toDateString())
			->where('promotion.end_date','>=',Carbon::today()->toDateString());
	}

	public static function SubCatePromotions() {
		return DB::table('promotion')
			->select('promotion.*')
			->where('promotion.product_status',2)
			->groupBy('promotion.promo_percent')
			->orderBy('promotion.promo_percent','desc')
			->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
			->leftJoin('categories','categories.id','promotion_detail.product_id')
			->where('promotion.start_date','<=',Carbon::today()->toDateString())
			->where('promotion.end_date','>=',Carbon::today()->toDateString());
	}

	public static function BrandsPromotions() {;
		return DB::table('promotion')
			->select('promotion.*')
			->where('promotion.product_status',4)
			->groupBy('promotion.promo_percent')
			->orderBy('promotion.promo_percent','desc')
			->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
			->leftJoin('items','items.brands_id','promotion_detail.product_id')
			->where('promotion.start_date','<=',Carbon::today()->toDateString())
			->where('promotion.end_date','>=',Carbon::today()->toDateString());
	}
	
	public static function ItemsPromotions() {
		return DB::table('promotion')
			->whereIn('promotion.product_status',[1,3])
			->groupBy('promotion.promo_percent')
			->orderBy('promotion.promo_percent','desc')
			->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
			->where('promotion.start_date','<=',Carbon::today()->toDateString())
			->where('promotion.end_date','>=',Carbon::today()->toDateString());
	}

	public static function AllPromotions() {
		return DB::table('promotion')
			->where('promotion.status',1)
			->orderBy('promotion.promo_amount','desc')
			->orderBy('promotion.promo_percent','desc')
			->orderBy('promotion.created_at','desc')
			->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
			->where('promotion.start_date','<=',Carbon::today()->toDateString())
			->where('promotion.end_date','>=',Carbon::today()->toDateString());
	}
}
