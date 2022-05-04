<?php

namespace App\Http\Controllers;

use Auth;
use App\uiconfig;
use App\serviceconfig;
use App\contact_us;
use App\about_us;
use App\main_category;
use App\sub_category;
use App\category;
use App\brand;
use App\item;
use App\item_specification;
use App\Order;
use App\promotions;
use App\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(){
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        $count_new = Item::where('status',1)->count();
        if($count_new == 0){
            $new_items = "";
        } else {
            $new_items = Item::where('status',1)->orderBy('created_at','desc')->take(8)->get();
            foreach($new_items as $new) {
                $check_promotions = Promotions::AllPromotions()
                                ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                                ->get();
                foreach($check_promotions as $check_promotion) {
                    if($check_promotion->product_status == 2) {
                        if($check_promotion->product_id == $new->categories_id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $new->promotion_id = $promotion->id;
                            $new->promo_amount = $promotion->promo_amount;
                            $new->promo_percent = $promotion->promo_percent;
                        }
                    } elseif ($check_promotion->product_status == 4) {
                        if($check_promotion->product_id == $new->brands_id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $new->promotion_id = $promotion->id;
                            $new->promo_amount = $promotion->promo_amount;
                            $new->promo_percent = $promotion->promo_percent;
                        }
                    } elseif ($check_promotion->product_status == 1 || $check_promotion->product_status == 3) {
                        if($check_promotion->product_id == $new->id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $new->promotion_id = $promotion->id;
                            $new->promo_amount = $promotion->promo_amount;
                            $new->promo_percent = $promotion->promo_percent;
                        }
                    }
                }
                if($new->brands_id == NULL || $new->brands_id == '') {
                    $new->brand_name = NULL;
                } else {
                    $new->brand_name = DB::table('brands')->where('brands.id',$new->brands_id)->value('name');
                }
                $new->saleprice = Item::SalePrice($new->id);
                if (isset($new->promotion_id)) {
                    $for_discount = [
                        'id' => $new->id,
                        'promotion_id' => $new->promotion_id
                    ];
                    $new->discount_price = Item::DiscountPrice($for_discount);
                }
            }
        }

        $count_best = Order::where('orders.status',1)
                        ->leftJoin('orders_detail','orders_detail.order_id','orders.id')
                        ->leftJoin('items','items.id','orders_detail.item_id')
                        ->where('items.status',1)
                        ->count();
        if($count_best == 0){
            $best_items = "";
        } else {
            $best_items = DB::table('items')
                    ->select('items.*')
                    ->leftJoin('orders_detail','orders_detail.item_id','items.id')
                    ->groupBy('orders_detail.item_id')
                    ->having('orders_detail.item_id', '>', 1)
                    ->where('items.status',1)
                    ->take(8)
                    ->get();
            foreach($best_items as $best) {
                $check_promotions = Promotions::AllPromotions()
                                ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                                ->get();
                foreach($check_promotions as $check_promotion) {
                    if($check_promotion->product_status == 2) {
                        if($check_promotion->product_id == $best->categories_id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $best->promotion_id = $promotion->id;
                            $best->promo_amount = $promotion->promo_amount;
                            $best->promo_percent = $promotion->promo_percent;
                        }
                    } elseif ($check_promotion->product_status == 4) {
                        if($check_promotion->product_id == $best->brands_id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $best->promotion_id = $promotion->id;
                            $best->promo_amount = $promotion->promo_amount;
                            $best->promo_percent = $promotion->promo_percent;
                        }
                    } elseif ($check_promotion->product_status == 1 || $check_promotion->product_status == 3) {
                        if($check_promotion->product_id == $best->id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $best->promotion_id = $promotion->id;
                            $best->promo_amount = $promotion->promo_amount;
                            $best->promo_percent = $promotion->promo_percent;
                        }
                    }
                }
                if($best->brands_id == NULL || $best->brands_id == '') {
                    $best->brand_name = NULL;
                } else {
                    $best->brand_name = DB::table('brands')->where('brands.id',$best->brands_id)->value('name');
                }
                $best->saleprice = Item::SalePrice($best->id);
                if (isset($best->promotion_id)) {
                    $for_discount = [
                        'id' => $best->id,
                        'promotion_id' => $best->promotion_id
                    ];
                    $best->discount_price = Item::DiscountPrice($for_discount);
                }
            }
        }

        $count_dis = Promotions::where('promotion.status',1)
                        ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                        ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                        ->count();
        if($count_dis == 0){
            $dis_items = "";
        } else {
            $promos = Promotions::AllPromotions()
                    ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                    ->get();
            $dis_items = collect();
            foreach ($promos as $promo) {
                $discount = Item::where('items.status',1);
                if ($promo->product_status == '2') {
                    $discount = $discount->where('items.categories_id',$promo->product_id)
                                        ->leftJoin('promotion_detail','promotion_detail.product_id','items.categories_id');
                } elseif ($promo->product_status == '4') {
                    $discount = $discount->where('items.brands_id',$promo->product_id)
                                        ->leftJoin('promotion_detail','promotion_detail.product_id','items.brands_id');
                } elseif ($promo->product_status == '1' || $promo->product_status == '3') {
                    $discount = $discount->where('items.id',$promo->product_id)
                                        ->leftJoin('promotion_detail','promotion_detail.product_id','items.id');
                }
                $dis_items->push($discount->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                                    ->where('promotion.status',1)
                                    ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                                    ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                                    ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent')
                                    ->get());
            }
            $dis_items = $dis_items->flatten()->slice(0,8);
            foreach($dis_items as $dis) {
                if($dis->brands_id == NULL || $dis->brands_id == '') {
                    $dis->brand_name = NULL;
                } else {
                    $dis->brand_name = DB::table('brands')->where('brands.id',$dis->brands_id)->value('name');
                }
                $dis->saleprice = Item::SalePrice($dis->id);
                $for_discount = [
                    'id' => $dis->id,
                    'promotion_id' => $dis->promotion_id
                ];
                $dis->discount_price = Item::DiscountPrice($for_discount);
            }
        }
        $trend_data = [
            'new_items' => $new_items,
            'best_items' => $best_items,
            'dis_items' => $dis_items
        ];
        $users = array();
        $check_promos = DB::table('promo_code')
                    ->where('start_date','<=',\Carbon\Carbon::today()->toDateString())
                    ->where('end_date','>=',\Carbon\Carbon::today()->toDateString())
                    ->where('status',1)
                    ->get();
        if($check_promos->count() != 0) {
            if(Auth::check()) {
                foreach($check_promos as $check_promo) {
                    $users = json_decode($check_promo->users_id);
                    if(is_array($users) || is_object($users)) {
                        foreach($users as $user) {
                            if($user == Auth::user()->id) {
                                $promo_code = DB::table('promo_code')->where('id',$check_promo->id)->first();
                            } else {
                                $promo_code = "";
                            }
                        }
                    }
                }
            } else {
                $promo_code = "";
            }
        } else {
            $promo_code = "";
        }

        $slider = ['Slider1','Slider2','Slider3','Slider4','Slider5','Slider6','Slider7','Slider8'];
        $slider_img = DB::table('ui_config')->where('status',1)->whereIn('indexname',$slider)->get();

        $insta = ['Insta1','Insta2','Insta3','Insta4','Insta5','Insta6'];
        $insta_img = DB::table('ui_config')->where('status',1)->whereIn('indexname',$insta)->get();

        $service = ['service_1','service_2','service_3','service_4'];
        $ui_service = DB::table('service_config')->where('status',1)->whereIn('type',$service)->get();
        return view('frontEnd.index',compact('slider_img', 'insta_img', 'ui_service', 'promo_code'))->with($trend_data);
    }

    public function autocomplete_item(Request $request)
    {
        $data = DB::table('items')->select("id","name","image_url1","item_code")
                ->where("name","LIKE","{$request->input('query')}%")
                ->where('status',1)
                ->get();
        $data_count = count($data);
        if($data_count == 0){
            $data = DB::table('items')->join('categories','categories.id','=','items.categories_id')->select("items.id","items.name","items.image_url1","items.item_code")
                ->where("categories.name","LIKE","{$request->input('query')}%")
                ->where('items.status',1)
                ->get();
                $data_count2 = count($data);
                if($data_count2 == 0){
                    $data = DB::table('items')->join('categories','categories.id','=','items.categories_id')->join('sub_categories','sub_categories.id','=','categories.sub_categories_id')->select("items.id","items.name","items.image_url1","items.item_code")
                    ->where("sub_categories.name","LIKE","{$request->input('query')}%")
                    ->where('items.status',1)
                    ->get();
                }
        }
        $count = count($data);
        for($i = 0;$i< $count ;$i++){
            $data[$i]->id = Crypt::encrypt($data[$i]->id);
        }
        return response()->json($data);
    }

    public function itemSearch(Request $request)
    {
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        $items = DB::table('items')
                ->where("name","LIKE","{$request->input('query')}%")
                ->where('status',1)
                ->paginate(12);
        $data_count = count($items);
        if($data_count == 0){
            $items = DB::table('items')->join('categories','categories.id','=','items.categories_id')->select('items.*')
                ->where("categories.name","LIKE","{$request->input('query')}%")
                ->where('items.status',1)
                ->paginate(12);
                $data_count2 = count($items);
                if($data_count2 == 0){
                    $items = DB::table('items')->join('categories','categories.id','=','items.categories_id')->join('sub_categories','sub_categories.id','=','categories.sub_categories_id')->select('items.*')
                    ->where("sub_categories.name","LIKE","{$request->input('query')}%")
                    ->where('items.status',1)
                    ->paginate(12);
                }
        }
        foreach($items as $item) {
            $check_promotions = Promotions::AllPromotions()
                                ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                                ->get();
            foreach($check_promotions as $check_promotion) {
                if($check_promotion->product_status == 2) {
                    if($check_promotion->product_id == $item->categories_id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $item->promotion_id = $promotion->id;
                        $item->promo_amount = $promotion->promo_amount;
                        $item->promo_percent = $promotion->promo_percent;
                    }
                } elseif ($check_promotion->product_status == 4) {
                    if($check_promotion->product_id == $item->brands_id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $item->promotion_id = $promotion->id;
                        $item->promo_amount = $promotion->promo_amount;
                        $item->promo_percent = $promotion->promo_percent;
                    }
                } elseif ($check_promotion->product_status == 1 || $check_promotion->product_status == 3) {
                    if($check_promotion->product_id == $item->id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $item->promotion_id = $promotion->id;
                        $item->promo_amount = $promotion->promo_amount;
                        $item->promo_percent = $promotion->promo_percent;
                    }
                }
            }
            if($item->brands_id == NULL || $item->brands_id == '') {
                $item->brand_name = NULL;
            } else {
                $item->brand_name = DB::table('brands')->where('brands.id',$item->brands_id)->value('name');
            }
            $item->saleprice = Item::SalePrice($item->id);
            if (isset($item->promotion_id)) {
                $for_discount = [
                    'id' => $item->id,
                    'promotion_id' => $item->promotion_id
                ];
                $item->discount_price = Item::DiscountPrice($for_discount);
            }
        }
        $item_data = [
            'items' => $items
        ];
        $byMainCate="";
        $bySubCate="";
        $byBrand="";
        $byCate="";
        $data="";
        $sub_categories = Sub_category::where('status',1)->get();

        return view('frontEnd.products',compact('byMainCate', 'bySubCate', 'byBrand', 'byCate', 'sub_categories', 'data'))->with($item_data);
    }

    public function shop(){
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        $items = Item::where('status', 1)->paginate(12);
        foreach($items as $item) {
            $check_promotions = Promotions::AllPromotions()
                                ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                                ->get();
            foreach($check_promotions as $check_promotion) {
                if($check_promotion->product_status == 2) {
                    if($check_promotion->product_id == $item->categories_id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $item->promotion_id = $promotion->id;
                        $item->promo_amount = $promotion->promo_amount;
                        $item->promo_percent = $promotion->promo_percent;
                    }
                } elseif ($check_promotion->product_status == 4) {
                    if($check_promotion->product_id == $item->brands_id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $item->promotion_id = $promotion->id;
                        $item->promo_amount = $promotion->promo_amount;
                        $item->promo_percent = $promotion->promo_percent;
                    }
                } elseif ($check_promotion->product_status == 1 || $check_promotion->product_status == 3) {
                    if($check_promotion->product_id == $item->id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $item->promotion_id = $promotion->id;
                        $item->promo_amount = $promotion->promo_amount;
                        $item->promo_percent = $promotion->promo_percent;
                    }
                }
            }
            if($item->brands_id == NULL || $item->brands_id == '') {
                $item->brand_name = NULL;
            } else {
                $item->brand_name = DB::table('brands')->where('brands.id',$item->brands_id)->value('name');
            }
            $item->saleprice = Item::SalePrice($item->id);
            if (isset($item->promotion_id)) {
                $for_discount = [
                    'id' => $item->id,
                    'promotion_id' => $item->promotion_id
                ];
                $item->discount_price = Item::DiscountPrice($for_discount);
            }
        }
        $item_data = [
            'items' => $items
        ];
        $byMainCate="";
        $bySubCate="";
        $byBrand="";
        $byCate="";
        $data="";

        $sub_categories = Sub_category::where('status','=',1)->get();
        return view('frontEnd.products',compact('byMainCate', 'bySubCate', 'byBrand', 'byCate', 'sub_categories', 'data'))->with($item_data);
    }

    public function detailitem(Request $request,$id){
        Session::forget(['checkout_process']);
        $id = Crypt::decrypt($id);
        $detail_item = Item::findOrFail($id);

        if($detail_item->brands_id == NULL || $detail_item->brands_id == '') {
            $detail_item->brand_name = NULL;
        } else {
            $detail_item->brand_name = DB::table('brands')->where('brands.id',$detail_item->brands_id)->value('name');
        }
        if($request->has('promotion_id')) {
            $promotion = Promotions::where('id',$request->promotion_id)->select('promo_amount','promo_percent')->first();
            $detail_item->promotion_id = $request->promotion_id;
            $detail_item->promo_amount = $promotion->promo_amount;
            $detail_item->promo_percent = $promotion->promo_percent;
        } else {
            $check_promotions = Promotions::AllPromotions()
                                ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                                ->get();
            foreach($check_promotions as $check_promotion) {
                if($check_promotion->product_status == 2) {
                    if($check_promotion->product_id == $detail_item->categories_id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $detail_item->promotion_id = $promotion->id;
                        $detail_item->promo_amount = $promotion->promo_amount;
                        $detail_item->promo_percent = $promotion->promo_percent;
                    }
                } elseif ($check_promotion->product_status == 4) {
                    if($check_promotion->product_id == $detail_item->brands_id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $detail_item->promotion_id = $promotion->id;
                        $detail_item->promo_amount = $promotion->promo_amount;
                        $detail_item->promo_percent = $promotion->promo_percent;
                    }
                } elseif ($check_promotion->product_status == 1 || $check_promotion->product_status == 3) {
                    if($check_promotion->product_id == $detail_item->id) {
                        $promotion = Promotions::where('id',$check_promotion->id)
                                    ->select('id','promo_amount','promo_percent')
                                    ->first();
                        $detail_item->promotion_id = $promotion->id;
                        $detail_item->promo_amount = $promotion->promo_amount;
                        $detail_item->promo_percent = $promotion->promo_percent;
                    }
                }
            }
        }
        if($detail_item->sale_type == 0) {
            $detail_item->total_instock = DB::table('items_specification')->where('items_id', $id)->sum('qty');
        } else {
            $detail_item->total_instock = 0;
        }
        $detail_item->saleprice = Item::SalePrice($id);
        $detail_item->specifications = Item_specification::where('items_id',$id)->get();
        if (isset($detail_item->promotion_id)) {
            $for_discount = [
                'id' => $detail_item->id,
                'promotion_id' => $detail_item->promotion_id
            ];
            $detail_item->discount_price = Item::DiscountPrice($for_discount);
        }

        $count_related = Item::where([['id','!=',$id],['categories_id',$detail_item->categories_id],['status',1]])->count();
        if ($count_related == 0) {
            $related_items = "";
        } else {
            $related_items = Item::where([['id','!=',$id],['categories_id',$detail_item->categories_id],['status',1]])->take(8)->get();
            foreach($related_items as $item) {
                $check_promotions = Promotions::AllPromotions()
                                    ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                                    ->get();
                foreach($check_promotions as $check_promotion) {
                    if($check_promotion->product_status == 2) {
                        if($check_promotion->product_id == $item->categories_id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $item->promotion_id = $promotion->id;
                            $item->promo_amount = $promotion->promo_amount;
                            $item->promo_percent = $promotion->promo_percent;
                        }
                    } elseif ($check_promotion->product_status == 4) {
                        if($check_promotion->product_id == $item->brands_id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $item->promotion_id = $promotion->id;
                            $item->promo_amount = $promotion->promo_amount;
                            $item->promo_percent = $promotion->promo_percent;
                        }
                    } elseif ($check_promotion->product_status == 1 || $check_promotion->product_status == 3) {
                        if($check_promotion->product_id == $item->id) {
                            $promotion = Promotions::where('id',$check_promotion->id)
                                        ->select('id','promo_amount','promo_percent')
                                        ->first();
                            $item->promotion_id = $promotion->id;
                            $item->promo_amount = $promotion->promo_amount;
                            $item->promo_percent = $promotion->promo_percent;
                        }
                    }
                }
                if($item->brands_id == NULL || $item->brands_id == '') {
                    $item->brand_name = NULL;
                } else {
                    $item->brand_name = DB::table('brands')->where('brands.id',$item->brands_id)->value('name');
                }
                $item->saleprice = Item::SalePrice($item->id);
                if (isset($item->promotion_id)) {
                    $for_discount = [
                        'id' => $item->id,
                        'promotion_id' => $item->promotion_id
                    ];
                    $item->discount_price = Item::DiscountPrice($for_discount);
                }
            }
        }
        return view('frontEnd.product_details',compact('detail_item','related_items'));
    }

    public function getColors(Request $request){
        $all_attrs=$request->all();
        $attr=explode('-',$all_attrs['size']);
        $result_colors=Item_specification::where(['items_id'=>$attr[0],'size'=>$attr[1]])->select('color')->get();
        foreach ($result_colors as $result_color) {
            echo $result_color->color.",";
        }
    }

    public function getSpecs(Request $request){
        $all_attrs=$request->all();
        $attr=explode('-',$all_attrs['color']);
        $result=Item_specification::where(['items_id'=>$attr[0],'size'=>$attr[1],'color'=>$attr[2]])->select('id','qty')->first();
        // $sale_type=Item::where(['id'=>$attr[0]])->select('sale_type')->value('sale_type');
        echo $result->id."/".$result->qty;
    }

    public function showFavourite(){
        $favourites = DB::table('favourites')
                    ->join('items', 'favourites.items_id', '=', 'items.id')
                    ->select('items.*')
                    ->paginate(8);
        return view('frontEnd.users.favourites',compact('favourites'));
    }

    public function addFavourite(Request $request,$id){
        $add_fav = new Favourite;
        $add_fav->users_id = Auth::user()->id;
        $add_fav->items_id = $id;
        $add_fav->created_by = Auth::user()->id;
        $add_fav->save();
        return back()->with('success','Successfully Added to Your Favourites');
    }

    public function removeFavourite(Request $request,$id){
        $remove_fav = Favourite::where([['users_id', Auth::user()->id], ['items_id', $id]])->forceDelete();
        return back()->with('alert','Successfully Removed from Your Favourites');
    }

    // public function calculator(Request $request){
    //     $countries_id = $request->country_id;
    //     $price = $request->price;

    //     if($countries_id == 1){
    //         $currency=DB::table("countries")->where('id','=',$countries_id)->value('exchange_rate');
    //         $purchase = $price*$currency;
        
    //         if($purchase <= 70000) {
    //             $profit_id = 1;
    //             $profit = DB::table("profit")->where('id','=',1)->value('percentage');
    //         } elseif($purchase > 70000 && $purchase <= 140000) {
    //             $profit_id = 2;
    //             $profit = DB::table("profit")->where('id','=',2)->value('percentage');
    //         } elseif($purchase > 140000 && $purchase <= 210000) {
    //             $profit_id = 3;
    //             $profit = DB::table("profit")->where('id','=',3)->value('percentage');
    //         } elseif($purchase > 210000) {
    //             $profit_id = 4;
    //             $profit = DB::table("profit")->where('id','=',4)->value('percentage');
    //         }
        
    //         $profit_percent = $profit/100;
    //         $purchase_percent = $purchase * $profit_percent;
    //         $purchase_price = $purchase + $purchase_percent;
    //     } elseif($countries_id == 2) {
    //         $currency=DB::table("countries")->where('id','=',$countries_id)->value('exchange_rate');
    //         $purchase = $price*$currency;
    //         if($purchase <= 70000) {
    //             $profit_id = 1;
    //             $profit = DB::table("profit")->where('id','=',1)->value('percentage');
    //         } elseif($purchase > 70000 && $purchase <= 140000) {
    //             $profit_id = 2;
    //             $profit = DB::table("profit")->where('id','=',2)->value('percentage');
    //         } elseif($purchase > 140000 && $purchase <= 210000) {
    //             $profit_id = 3;
    //             $profit = DB::table("profit")->where('id','=',3)->value('percentage');
    //         } elseif($purchase > 210000) {
    //             $profit_id = 4;
    //             $profit = DB::table("profit")->where('id','=',4)->value('percentage');
    //         }
    //         $profit_percent = $profit/100;
    //         $purchase_percent = $purchase * $profit_percent;
    //         $purchase_price = $purchase + $purchase_percent;
    //     }
    //     $sale_price = (int)round($purchase_price);
    //     $sub=substr($sale_price,-2,2);
    //     if($sub == 00) {
    //         $sale_price;
    //     } elseif($sub < 50) {
    //         $sale_price = substr_replace($sale_price,50,-2,2);
    //     } else {
    //         $sale_price += 100;
    //         $minus = substr($sale_price,-2,2);
    //         $sale_price -= $minus;
    //     }
    //     echo $sale_price;
    // }

    public function career() {
        $career = ['Career1','Career2','Career3','Career4','Career5'];
        $career_img = DB::table('ui_config')->where('status',1)->whereIn('indexname',$career)->get();
        return view('frontEnd.career',compact('career_img'));
    }

    public function contact_us() {
        $contact_us = DB::table('contact_us')->first();
        return view('frontEnd.contact_us',compact('contact_us'));
    }

    public function about_us() {
        $about_us = DB::table('about_us')->first();
        $get_items = DB::table('items')->get();
        $all_items = count($get_items);
        $all_sub_categories = DB::table('sub_categories')->orderBy('id','ASC')->select('id','name')->get();
        foreach($all_sub_categories as $sub_category) {
            $total_items = DB::table('items')
                            ->leftJoin('categories','categories.id','items.categories_id')
                            ->where('categories.sub_categories_id',$sub_category->id)
                            ->get();
            $sub_category->total_items = count($total_items);
        }
        $all_brands = DB::table('brands')->orderBy('id','ASC')->select('id','name')->get();
        foreach($all_brands as $brand) {
            $total_items = DB::table('items')
                            ->where('items.brands_id',$brand->id)
                            ->get();
            $brand->total_items = count($total_items);
        }
        return view('frontEnd.about_us',compact('about_us','all_items','all_sub_categories','all_brands'));
    }

    public function privacy_policy() {
        return view('frontEnd.privacy_policy');
    }

    public function terms_and_conditions() {
        return view('frontEnd.terms_and_conditions');
    }
}
