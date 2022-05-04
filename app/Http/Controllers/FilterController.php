<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\main_category;
use App\sub_category;
use App\category;
use App\brand;
use App\item;
use App\promotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterController extends Controller
{
    public function listByMainCat($id){
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        $items = Item::MainCategoriesBasedItems()->where('sub_categories.main_categories_id',$id)->paginate(12);
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

        $byMainCate = Main_category::where('id',$id)->first();
        $bySubCate = "";
        $byBrand = "";
        $byCate = "";
        $data = "";

        $sub_categories = Sub_category::MainCategoriesBasedSubCategories()->where('sub_categories.main_categories_id',$id)->get();
        return view('frontEnd.products',compact('byMainCate', 'bySubCate', 'byBrand', 'byCate', 'sub_categories', 'data'))->with($item_data);
    }

    public function listBySubCat($id){
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        $items = Item::SubCategoriesBasedItems()->where('categories.sub_categories_id',$id)->paginate(12);
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

        $byMainCate = "";
        $bySubCate = Sub_category::where('id',$id)->first();
        $byBrand = "";
        $byCate = "";
        $data = "";

        $sub_categories = Sub_category::where([['id',$id],['status',1]])->get();
        return view('frontEnd.products',compact('byMainCate', 'bySubCate', 'byBrand', 'byCate', 'sub_categories', 'data'))->with($item_data);
    }

    public function listByBrand($id){
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        if($id == 0) {
            $items = Item::where('items.status',1)->whereNull('items.brands_id')->paginate(12);
        } else {
            $items = Item::where([['items.brands_id',$id],['items.status',1]])->paginate(12);
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

        $byMainCate = "";
        $bySubCate = "";
        $byBrand = Brand::where('id',$id)->first();
        $byCate = "";
        $data = "";

        $sub_categories = Sub_category::BrandBasedSubCategories()->where('items.brands_id',$id)->get();
        return view('frontEnd.products',compact('byMainCate', 'bySubCate', 'byBrand', 'byCate', 'sub_categories', 'data'))->with($item_data);
    }

    public function filter_products(Request $request) {
        $data = $request->all();
        Session::put('product', $request['product']);
        Session::put('category', $request['category']);
        Session::put('minprice', $request['minprice']);
        Session::put('maxprice', $request['maxprice']);
        Session::put('trend', $request['trend']);

        if ($request['maincategory_id']) {

            $items = Item::MainCategoriesBasedItems()->where('sub_categories.main_categories_id',$request['maincategory_id']);

            $byMainCate = Main_category::where('id',$request['maincategory_id'])->first();
            $bySubCate = "";
            $byBrand = "";
            $byCate = "";

            $sub_categories = Sub_category::MainCategoriesBasedSubCategories()->where('sub_categories.main_categories_id',$request['maincategory_id'])->get();
        }
        elseif ($request['subcategory_id']) {

            $items = Item::SubCategoriesBasedItems()->where('categories.sub_categories_id',$request['subcategory_id']);

            $byMainCate = "";
            $bySubCate = Sub_category::where('id',$request['subcategory_id'])->first();
            $byBrand = "";
            $byCate = "";

            $sub_categories = Sub_category::where([['id',$request['subcategory_id']],['status',1]])->get();
        }
        elseif ($request['brand_id']) {

            $items = Item::where('items.status',1)->where('items.brands_id',$request['brand_id']);

            $byMainCate = "";
            $bySubCate = "";
            $byBrand = Brand::where('id',$request['brand_id'])->first();
            $byCate = "";

            $sub_categories = Sub_category::BrandBasedSubCategories()->where('items.brands_id',$request['brand_id'])->get();
        }
        else {
            $items = Item::where('items.status',1);

            $byMainCate="";
            $bySubCate="";
            $byBrand="";
            $byCate = "";

            $sub_categories = Sub_category::where('status','=',1)->get();
        }

        if($request['product'] == "instock") {
            $items = $items->where('sale_type',0);
        }
        if($request['product'] == "preorder") {
            $items = $items->where('sale_type',1);
        }
        if($request['category']) {
            $items = $items->where('items.categories_id',$request['category']);
            $byCate = Category::where('id',$request['category'])->first();
        }
        if($request['trend'] == "new") {
            $items = $items->orderBy('created_at','desc');
        }
        if($request['trend'] == "best") {
            $items = $items->select('items.*')
                        ->leftJoin('orders_detail','orders_detail.item_id','items.id')
                        ->groupBy('orders_detail.item_id')
                        ->having('orders_detail.item_id', '>', 1);
        }
        if($request['trend'] == "promotion") {
            if($request['maincategory_id'] || $request['subcategory_id']) {
                $items = $items->leftJoin('promotion_detail','promotion_detail.product_id','items.categories_id')
                            ->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                            ->where('promotion.product_status',2)
                            ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                            ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                            ->where('promotion.status',1)
                            ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent');
            } elseif ($request['brand_id']) {
                $items = $items->leftJoin('promotion_detail','promotion_detail.product_id','items.brands_id')
                            ->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                            ->where('promotion.product_status',4)
                            ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                            ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                            ->where('promotion.status',1)
                            ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent');
            } elseif ($request['category']) {
                $items = $items->leftJoin('promotion_detail','promotion_detail.product_id',$request['category'])
                            ->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                            ->where('promotion.product_status',2)
                            ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                            ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                            ->where('promotion.status',1)
                            ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent');
            } else {
                $items = $items->leftJoin('promotion_detail','promotion_detail.product_id','items.id')
                            ->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                            ->whereIn('promotion.product_status',[1,3])
                            ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                            ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                            ->where('promotion.status',1)
                            ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent');
            }
        }

        $items = $items->paginate(12);
        foreach($items as $item) {
            if($request['trend'] != "promotion") {
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

        //Minimum and Maximum price range filter
        foreach($items as $key => $value) {
            if(isset($value->discount_price)) {
                $price = $value->discount_price;
            } else {
                $price = $value->saleprice;
            }
            if($request['minprice'] != null && $request['maxprice'] != null) {
                if(!($price >= $request['minprice'] && $price <= $request['maxprice'])) {
                    $items->forget($key);
                }
            } else if($request['minprice'] != null && $request['maxprice'] == null) {
                if(!($price >= $request['minprice'])) {
                    $items->forget($key);
                }
            } else if($request['minprice'] == null && $request['maxprice'] != null) {
                if(!($price <= $request['maxprice'])) {
                    $items->forget($key);
                }
            }
        }

        $item_data = [
            'items' => $items
        ];
        // dd($items);

        return view('frontEnd.products',compact('byMainCate', 'bySubCate', 'byBrand', 'byCate', 'sub_categories', 'data'))->with($item_data);
    }

    public function allPromotions(){
        Session::forget(['product','category','minprice','maxprice','trend','promotion']);
        $count_dis = Promotions::where('promotion.status',1)
                        ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                        ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                        ->count();
        if($count_dis == 0){
            $paginatedItems = array();
        } else {
            $promos = Promotions::AllPromotions()
                    ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                    ->get();
            $items = collect();
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
                $items->push($discount->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                                    ->where('promotion.status',1)
                                    ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                                    ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                                    ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent')
                                    ->get());
            }
            $items = $items->flatten();
            foreach($items as $item) {
                if($item->brands_id == NULL || $item->brands_id == '') {
                    $item->brand_name = NULL;
                } else {
                    $item->brand_name = DB::table('brands')->where('brands.id',$item->brands_id)->value('name');
                }
                $item->saleprice = Item::SalePrice($item->id);
                $for_discount = [
                    'id' => $item->id,
                    'promotion_id' => $item->promotion_id
                ];
                $item->discount_price = Item::DiscountPrice($for_discount);
            }
            
            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            // Define how many items we want to be visible in each page
            $perPage = 12;
            // Slice the collection to get the items to display in current page
            $currentPageItems = $items->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            // Create our paginator and pass it to the view
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($items), $perPage);
            // set url path for generted links
            $paginatedItems->setPath(url()->current());
        }
        
        $data = "";
        $byData = "";
        $promotions = DB::table('promotion')
                    ->where('promotion.status',1)
                    ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                    ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                    ->whereNull('promotion.promo_amount')
                    ->groupBy('promotion.promo_percent')
                    ->orderBy('promotion.promo_percent','desc')
                    ->select('promotion.promo_percent')
                    ->get();
        return view('frontEnd.promotions.promotions',compact('data','byData','promotions'))->with(['items' => $paginatedItems]);
    }

    public function specificPromotions(Request $request){
        $data = $request->all();
        Session::put('promotion', $request['promotion']);

        if($request['promotion'] == "All") {
            return redirect()->route('allpromotions');
        } elseif($request['promotion'] == "Sale") {
            $check_promotions = Promotions::AllPromotions()
                    ->whereNull('promotion.promo_percent')
                    ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                    ->get();
            $promo_items = collect();
            foreach ($check_promotions as $check_promotion) {
                $items = Item::where('items.status',1);
                if ($check_promotion->product_status == '2') {
                    $items = $items->where('items.categories_id',$check_promotion->product_id)
                                ->leftJoin('promotion_detail','promotion_detail.product_id','items.categories_id');
                } elseif ($check_promotion->product_status == '4') {
                    $items = $items->where('items.brands_id',$check_promotion->product_id)
                                ->leftJoin('promotion_detail','promotion_detail.product_id','items.brands_id');
                } elseif ($check_promotion->product_status == '1' || $check_promotion->product_status == '3') {
                    $items = $items->where('items.id',$check_promotion->product_id)
                                ->leftJoin('promotion_detail','promotion_detail.product_id','items.id');
                }
                $promo_items->push($items->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                                    ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent')
                                    ->get());
            }
            $promo_items = $promo_items->flatten();
        } else {
            $check_promotions = Promotions::AllPromotions()
                    ->whereNull('promotion.promo_amount')
                    ->where('promotion.promo_percent',$request['promotion'])
                    ->select('promotion.id','promotion.product_status','promotion_detail.product_id')
                    ->get();
            $promo_items = collect();
            foreach ($check_promotions as $check_promotion) {
                $items = Item::where('items.status',1);
                if ($check_promotion->product_status == '2') {
                    $items = $items->where('items.categories_id',$check_promotion->product_id)
                                ->leftJoin('promotion_detail','promotion_detail.product_id','items.categories_id');
                } elseif ($check_promotion->product_status == '4') {
                    $items = $items->where('items.brands_id',$check_promotion->product_id)
                                ->leftJoin('promotion_detail','promotion_detail.product_id','items.brands_id');
                } elseif ($check_promotion->product_status == '1' || $check_promotion->product_status == '3') {
                    $items = $items->where('items.id',$check_promotion->product_id)
                                ->leftJoin('promotion_detail','promotion_detail.product_id','items.id');
                }
                $promo_items->push($items->leftJoin('promotion','promotion.id','promotion_detail.p_id')
                                    ->select('items.*','promotion.id as promotion_id','promotion.promo_amount','promotion.promo_percent')
                                    ->get());
            }
            $promo_items = $promo_items->flatten();
        }
        foreach($promo_items as $item) {
            if($item->brands_id == NULL || $item->brands_id == '') {
                $item->brand_name = NULL;
            } else {
                $item->brand_name = DB::table('brands')->where('brands.id',$item->brands_id)->value('name');
            }
            $item->saleprice = Item::SalePrice($item->id);
            $for_discount = [
                'id' => $item->id,
                'promotion_id' => $item->promotion_id
            ];
            $item->discount_price = Item::DiscountPrice($for_discount);
        }

        $byData = $request['promotion'];
        $promotions = DB::table('promotion')
                    ->where('promotion.status',1)
                    ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                    ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                    ->whereNull('promotion.promo_amount')
                    ->groupBy('promotion.promo_percent')
                    ->orderBy('promotion.promo_percent','desc')
                    ->select('promotion.promo_percent')
                    ->get();

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Define how many items we want to be visible in each page
        $perPage = 12;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $promo_items->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($promo_items), $perPage);
        // set url path for generted links
        $paginatedItems->setPath(url()->current());
        return view('frontEnd.promotions.promotions',compact('data','byData','promotions'))->with(['items' => $paginatedItems]);
    }
}
