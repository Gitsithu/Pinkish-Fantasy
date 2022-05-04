<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\Utility as Utility;
use App\item;
use App\item_specification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class ItemController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status = 1;
        //$items = DB::select('SELECT i.* , c.name as category_name , b.name as brand_name , co.name as country_name
        $items = DB::select('SELECT i.* , c.name as category_name , b.name as brand_name
                        from items as i
                        JOIN categories as c
                        ON i.categories_id = c.id
                        /*JOIN countries as co
                        ON i.countries_id = co.id*/
                        JOIN brands as b
                        ON i.brands_id = b.id
                        Where i.status='.$status);


            $delete = DB::select('SELECT i.id,i.inactive_at from items as i
            Where i.inactive_at IS NOT NULL and curdate() > DATE_ADD(i.inactive_at, interval 30 day)');

            $item_s = DB::select('SELECT s.id
            from items_specification as s
            join items as i
            on i.id = s.items_id
            Where i.inactive_at IS NOT NULL
            and curdate() > DATE_ADD(i.inactive_at, interval 30 day)');

            $d_count = count($delete);

            $item_s_count = count($item_s);

            for($j=0;$j<$item_s_count;$j++){
            $item_s_f = $item_s[$j]->id;

            $s_delete =item_specification::find($item_s_f);
            $s_delete->forceDelete();
            }
            for($i=0;$i<$d_count;$i++){
            $f = $delete[$i]->id;

            $item = item::find($f);
            $item->forceDelete();

            }
            return view('backend_v2.item.index')
            ->with('items', $items);

            }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=DB::select('SELECT * from categories where status = 1 and deleted_at is null');
        $brands=DB::select('SELECT * from brands where status = 1 and deleted_at is null');
        $countries=DB::select('SELECT * from countries where status = 1 and deleted_at is null');
        $profits=DB::select('SELECT * from profit where deleted_at is null');

        return view('backend_v2.item.create')
        ->with('categories',$categories)
        ->with('brands',$brands)
        ->with('countries',$countries)
        ->with('profits',$profits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'status'                => 'required',
            'categories_id'         => 'required',
            'countries_id'          => 'required',
            'remark'                => 'max:255',
            'image_url1'            => 'required',
            'sale_type'             => 'required',
            // 'url'                   => 'url|unique:items,url',
            'purchase_price'        => 'required|numeric',


     ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        $name                = $request->input('name');
        if($name == null){
            $name = "";
        }
        $categories_id       = $request->input('categories_id');

        $countries_id        = $request->input('countries_id');
        $brands_id           = $request->input('brands_id');
        $sale_type           = $request->input('sale_type');
        $status              = $request->input('status');
        $url                 = $request->input('url');
        $description         = $request->input('description');
        $detail_info         = $request->input('detail_info');
        $remark              = $request->input('remark');
        $price               = $request->input('purchase_price');
        $additional_charges  = $request->input('additional_charges');
        $cargo               = $request->input('cargo_fee');
        $profit_id           = $request->input('profit_id');
        $shipping_fee        = $request->input('shipping_fee');
        $sale_price          = 0;
        if($additional_charges!=null){
            $this->validate($request, [
               'additional_charges' => 'numeric',
         ]);

        }

        // if($countries_id == 1){
        //     $currency=DB::table("countries")->where('id','=',$countries_id)->value('exchange_rate');


        //     $purchase = $price*$currency;

        //     if($purchase <= 70000){

        //         $profit = DB::table("profit")->where('id','=',1)->value('percentage');
        //     }
        //     elseif($purchase > 70000 && $purchase <= 140000){

        //         $profit = DB::table("profit")->where('id','=',2)->value('percentage');
        //     }
        //     elseif($purchase > 140000 && $purchase <= 210000){

        //         $profit = DB::table("profit")->where('id','=',3)->value('percentage');
        //     }
        //     elseif($purchase > 210000){

        //         $profit = DB::table("profit")->where('id','=',4)->value('percentage');
        //     }

        //     $profit_percent = $profit/100;
        //     $purchase_percent = $purchase * $profit_percent;
        //     $purchase_price = $purchase + $purchase_percent;

        // }
        // elseif($countries_id == 2){
        //     $currency=DB::table("countries")->where('id','=',$countries_id)->value('exchange_rate');
        //     $purchase = $price*$currency;
        //     if($purchase <= 70000){

        //         $profit = DB::table("profit")->where('id','=',1)->value('percentage');
        //     }
        //     elseif($purchase > 70000 && $purchase <= 140000){

        //         $profit = DB::table("profit")->where('id','=',2)->value('percentage');
        //     }
        //     elseif($purchase > 140000 && $purchase <= 210000){

        //         $profit = DB::table("profit")->where('id','=',3)->value('percentage');
        //     }
        //     elseif($purchase > 210000){

        //         $profit = DB::table("profit")->where('id','=',4)->value('percentage');
        //     }
        //     $profit_percent = $profit/100;
        //     $purchase_percent = $purchase * $profit_percent;
        //     $purchase_price = $purchase + $purchase_percent;

        // }
        // $sale_price = (int)round($purchase_price + $additional_charges + $cargo);
        // $sub=substr($sale_price,-2,2);
        // if($sub == 00){
        //     $sale_price;
        // }
        // elseif($sub < 50){
        //    $sale_price = substr_replace($sale_price,50,-2,2);
        // }
        // else{
        //     $sale_price += 100;
        //     $minus = substr($sale_price,-2,2);
        //     $sale_price -= $minus;
        // }
        $created_at          = date("Y-m-d H:i:s");

        $image_url_name1 = "";
        $image_url_name2 = "";
        $image_url_name3 = "";
        $image_url_name4 = "";
        $image_url_name5 = "";
        $image_url_name6 = "";
        $image_url_name7 = "";
        $image_url_name8 = "";
        $image_url_name9 = "";
        $image_url_name10 = "";

        $path = base_path() . '/public/item_images/';
        $image_path = '/item_images/';

        $path2 = base_path() . '/public/size_images/';
        $image_path2 = '/size_images/';


        //Start Saving Image 1
        $removeImageFlag1 = (Input::has('removeImageFlag1')) ? Input::get('removeImageFlag1') : 0;

        if (Input::hasFile('image_url1')) {
            $image_url1 = Input::file('image_url1');
            $image_url_name_original1 = Utility::getImage($image_url1);
            $image_url_ext1 = Utility::getImageExt($image_url1);
            $image_url_name1 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url1, $image_url_name1, $path);
        } else {
            $image_url_name1 = "";
        }

        if ($removeImageFlag1 == 1) {
            $image_url_name1 = "";

        }
        //End Saving Image 1

        //Start Saving Image 2
        $removeImageFlag2 = (Input::has('removeImageFlag2')) ? Input::get('removeImageFlag2') : 0;

        if (Input::hasFile('image_url2')) {
            $image_url2 = Input::file('image_url2');
            $image_url_name_original2 = Utility::getImage($image_url2);
            $image_url_ext2 = Utility::getImageExt($image_url2);
            $image_url_name2 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url2, $image_url_name2, $path);
        } else {
            $image_url_name2 = "";
        }

        if ($removeImageFlag2 == 1) {
            $image_url_name2 = "";
        }
        //End Saving Image 2

        //Start Saving Image 3
        $removeImageFlag3 = (Input::has('removeImageFlag3')) ? Input::get('removeImageFlag3') : 0;

        if (Input::hasFile('image_url3')) {
            $image_url3 = Input::file('image_url3');
            $image_url_name_original3 = Utility::getImage($image_url3);
            $image_url_ext3 = Utility::getImageExt($image_url3);
            $image_url_name3 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url3, $image_url_name3, $path);
        } else {
            $image_url_name3 = "";
        }

        if ($removeImageFlag3 == 1) {
            $image_url_name3 = "";
        }
        //End Saving Image 3

        //Start Saving Image 4
        $removeImageFlag4 = (Input::has('removeImageFlag4')) ? Input::get('removeImageFlag4') : 0;

        if (Input::hasFile('image_url4')) {
            $image_url4 = Input::file('image_url4');
            $image_url_name_original4 = Utility::getImage($image_url4);
            $image_url_ext4 = Utility::getImageExt($image_url4);
            $image_url_name4 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url4, $image_url_name4, $path);
        } else {
            $image_url_name4 = "";
        }

        if ($removeImageFlag4 == 1) {
            $image_url_name4 = "";
        }
        //End Saving Image 4

        //Start Saving Image 5
        $removeImageFlag5 = (Input::has('removeImageFlag5')) ? Input::get('removeImageFlag5') : 0;

        if (Input::hasFile('image_url5')) {
            $image_url5 = Input::file('image_url5');
            $image_url_name_original5 = Utility::getImage($image_url5);
            $image_url_ext5 = Utility::getImageExt($image_url5);
            $image_url_name5 = uniqid() . "." . $image_url_ext5;
            $image1 = Utility::resizeImage($image_url5, $image_url_name5, $path);
        } else {
            $image_url_name5 = "";
        }

        if ($removeImageFlag5 == 1) {
            $image_url_name5 = "";
        }
        //End Saving Image 5

        //Start Saving Image 6
        $removeImageFlag6 = (Input::has('removeImageFlag6')) ? Input::get('removeImageFlag6') : 0;

        if (Input::hasFile('image_url6')) {
            $image_url6 = Input::file('image_url6');
            $image_url_name_original6 = Utility::getImage($image_url6);
            $image_url_ext6 = Utility::getImageExt($image_url6);
            $image_url_name6 = uniqid() . "." . $image_url_ext6;
            $image1 = Utility::resizeImage($image_url6, $image_url_name6, $path);
        } else {
            $image_url_name6 = "";
        }

        if ($removeImageFlag6 == 1) {
            $image_url_name6 = "";
        }
        //End Saving Image 6

        //Start Saving Image 7
        $removeImageFlag7 = (Input::has('removeImageFlag7')) ? Input::get('removeImageFlag7') : 0;

        if (Input::hasFile('image_url7')) {
            $image_url7 = Input::file('image_url7');
            $image_url_name_original7 = Utility::getImage($image_url7);
            $image_url_ext7 = Utility::getImageExt($image_url7);
            $image_url_name7 = uniqid() . "." . $image_url_ext7;
            $image1 = Utility::resizeImage($image_url7, $image_url_name7, $path);
        } else {
            $image_url_name7 = "";
        }

        if ($removeImageFlag7 == 1) {
            $image_url_name7 = "";
        }
        //End Saving Image 7

        //Start Saving Image 8
        $removeImageFlag8 = (Input::has('removeImageFlag8')) ? Input::get('removeImageFlag8') : 0;

        if (Input::hasFile('image_url8')) {
            $image_url8 = Input::file('image_url8');
            $image_url_name_original8 = Utility::getImage($image_url8);
            $image_url_ext8 = Utility::getImageExt($image_url8);
            $image_url_name8 = uniqid() . "." . $image_url_ext8;
            $image1 = Utility::resizeImage($image_url8, $image_url_name8, $path);
        } else {
            $image_url_name8 = "";
        }

        if ($removeImageFlag8 == 1) {
            $image_url_name8 = "";
        }
        //End Saving Image 8
          //Start Saving Image 9
          $removeImageFlag9 = (Input::has('removeImageFlag9')) ? Input::get('removeImageFlag9') : 0;

          if (Input::hasFile('image_url9')) {
              $image_url9 = Input::file('image_url9');
              $image_url_name_original9 = Utility::getImage($image_url9);
              $image_url_ext9 = Utility::getImageExt($image_url9);
              $image_url_name9 = uniqid() . "." . $image_url_ext9;
              $image1 = Utility::resizeImage($image_url9, $image_url_name9, $path);
          } else {
              $image_url_name9 = "";
          }

          if ($removeImageFlag9 == 1) {
              $image_url_name9 = "";
          }
          //End Saving Image 9

        //Start Saving Image 10
          $removeImageFlag10 = (Input::has('removeImageFlag10')) ? Input::get('removeImageFlag10') : 0;

          if (Input::hasFile('image_url10')) {
              $image_url10 = Input::file('image_url10');
              $image_url_name_original10 = Utility::getImage($image_url10);
              $image_url_ext10 = Utility::getImageExt($image_url10);
              $image_url_name10 = uniqid() . "." . $image_url_ext10;
              $image1 = Utility::resizeImage($image_url10, $image_url_name10, $path2);
          } else {
              $image_url_name10 = "";
          }

          if ($removeImageFlag10 == 1) {
              $image_url_name10 = "";
          }
          //End Saving Image 10

        $image_file1 = '/item_images/' . $image_url_name1;
        $image_file2 = '/item_images/' . $image_url_name2;
        $image_file3 = '/item_images/' . $image_url_name3;
        $image_file4 = '/item_images/' . $image_url_name4;
        $image_file5 = '/item_images/' . $image_url_name5;
        $image_file6 = '/item_images/' . $image_url_name6;
        $image_file7 = '/item_images/' . $image_url_name7;
        $image_file8 = '/item_images/' . $image_url_name8;
        $image_file9 = '/item_images/' . $image_url_name9;
        $image_file10 = '/size_images/' . $image_url_name10;

        try{

        DB::insert('insert into items (name,categories_id,countries_id,brands_id,url,cargo_fee,shipping_fee,profit_id,image_url1,image_url2,image_url3,image_url4,image_url5,image_url6,image_url7,image_url8,image_url9,sale_type,image_url10,description,remark,additional_charges,purchase_price,sale_price,status,created_at,created_by) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$name,$categories_id,$countries_id,$brands_id,$url,$cargo,$shipping_fee,$profit_id,$image_file1,$image_file2,$image_file3,$image_file4,$image_file5,$image_file6,$image_file7,$image_file8,$image_file9,$sale_type,$image_file10,$description,$remark,$additional_charges,$price,$sale_price,$status,$created_at,$created_by]);

        $item                   = DB::table('items')->max('id');
        $categories_id          = DB::table('items')->where('id', $item)->value('categories_id');
        $sub_categories_id      = DB::table('categories')->where('id', $categories_id)->value('sub_categories_id');
        $main_categories_id     = DB::table('sub_categories')->where('id', $sub_categories_id)->value('main_categories_id');
        $item_code      = $main_categories_id.$sub_categories_id.$categories_id.$item;

        DB::update('update items set item_code = ? where id = ?',[$item_code,$item]);

                $message = 'Success, item created successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\ItemController@index'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in category creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\CategoryController@index'
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $id = Crypt::decrypt($id);
        $items = DB::table('items')->where('id', $id)->first();
        $item_specifications = DB::table('items_specification')->where('items_id', $id)->get();
        $countries = DB::table('countries')->where('status',1)->get();
        $categories = DB::table('categories')->where('status',1)->get();
        $brands = DB::table('brands')->where('status',1)->get();
        $profits = DB::table('profit')->get();


        return view('backend_v2.item.edit', ['items' => $items,'item_specifications' => $item_specifications,'brands' => $brands,'categories' => $categories,'countries' => $countries,'profits' => $profits]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'categories_id'         => 'required',
            'remark'                => 'max:255',
            // 'url'                   => 'url|unique:items,url,'.$id.'',
            'purchase_price'        => 'required|numeric',




        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $name                = $request->input('name');
        if($name == null){
            $name = "";
        }
        $categories_id       = $request->input('categories_id');
        $brands_id           = $request->input('brands_id');
        $sale_type           = $request->input('sale_type');
        $status              = $request->input('status');
        $url                 = $request->input('url');
        $description         = $request->input('description');
        $detail_info         = $request->input('detail_info');
        $remark              = $request->input('remark');
        $price               = $request->input('purchase_price');
        $additional_charges  = $request->input('additional_charges');
        $shipping_fee        = $request->input('shipping_fee');
        $cargo               = $request->input('cargo_fee');
        $profit_id           = $request->input('profit_id');


        if($additional_charges!=null){
            $this->validate($request, [
               'additional_charges' => 'numeric',
         ]);


        }

        $updated_at          = date("Y-m-d H:i:s");

        $countries_id = DB::table('items')->where('id', $id)->value('countries_id');
        $old_price    = DB::table('items')->where('id', $id)->value('purchase_price');
        $old_remark    = DB::table('items')->where('id', $id)->value('remark');
        $r= $remark;
        $p = $price;
        // if($countries_id == 1){
        //     $currency=DB::table("countries")->where('id','=',$countries_id)->value('exchange_rate');
        //     $purchase = $price*$currency;

        //     if($purchase <= 70000){
        //         $profit_id = 1;
        //         $profit = DB::table("profit")->where('id','=',1)->value('percentage');
        //     }
        //     elseif($purchase > 70000 && $purchase <= 140000){
        //         $profit_id = 2;
        //         $profit = DB::table("profit")->where('id','=',2)->value('percentage');
        //     }
        //     elseif($purchase > 140000 && $purchase <= 210000){
        //         $profit_id = 3;
        //         $profit = DB::table("profit")->where('id','=',3)->value('percentage');
        //     }
        //     elseif($purchase > 210000){
        //         $profit_id = 4;
        //         $profit = DB::table("profit")->where('id','=',4)->value('percentage');
        //     }
        //     $profit_percent = $profit/100;
        //     $purchase_percent = $purchase * $profit_percent;
        //     $purchase_price = $purchase + $purchase_percent;

        // }
        // elseif($countries_id == 2){
        //     $currency=DB::table("countries")->where('id','=',$countries_id)->value('exchange_rate');
        //     $purchase = $price*$currency;
        //     if($purchase <= 70000){
        //         $profit_id = 1;
        //         $profit = DB::table("profit")->where('id','=',1)->value('percentage');
        //     }
        //     elseif($purchase > 70000 && $purchase <= 140000){
        //         $profit_id = 2;
        //         $profit = DB::table("profit")->where('id','=',2)->value('percentage');
        //     }
        //     elseif($purchase > 140000 && $purchase <= 210000){
        //         $profit_id = 3;
        //         $profit = DB::table("profit")->where('id','=',3)->value('percentage');
        //     }
        //     elseif($purchase > 210000){
        //         $profit_id = 4;
        //         $profit = DB::table("profit")->where('id','=',4)->value('percentage');
        //     }
        //     $profit_percent = $profit/100;
        //     $purchase_percent = $purchase * $profit_percent;
        //     $purchase_price = $purchase + $purchase_percent;

        // }
        // $sale_price = (int)round($purchase_price + $additional_charges + $cargo);
        // $sub=substr($sale_price,-2,2);
        // if($sub == 00){
        //     $sale_price;
        // }
        // elseif($sub < 50){
        //    $sale_price = substr_replace($sale_price,50,-2,2);
        // }
        // else{
        //     $sale_price += 100;
        //     $minus = substr($sale_price,-2,2);
        //     $sale_price -= $minus;

        // }

        $category_id            = $categories_id;
        $sub_categories_id      = DB::table('categories')->where('id', $category_id)->value('sub_categories_id');
        $main_categories_id     = DB::table('sub_categories')->where('id', $sub_categories_id)->value('main_categories_id');
        $item_code      = $main_categories_id.$sub_categories_id.$category_id.$id;


        $removeImageFlag1 = (Input::has('removeImageFlag1')) ? Input::get('removeImageFlag1') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image1 = false;

        $removeImageFlag2 = (Input::has('removeImageFlag2')) ? Input::get('removeImageFlag2') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image2 = false;

        $removeImageFlag3 = (Input::has('removeImageFlag3')) ? Input::get('removeImageFlag3') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image3 = false;

        $removeImageFlag4 = (Input::has('removeImageFlag4')) ? Input::get('removeImageFlag4') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image4 = false;

        $removeImageFlag5 = (Input::has('removeImageFlag5')) ? Input::get('removeImageFlag5') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image5 = false;

        $removeImageFlag6 = (Input::has('removeImageFlag6')) ? Input::get('removeImageFlag6') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image6 = false;

        $removeImageFlag7 = (Input::has('removeImageFlag7')) ? Input::get('removeImageFlag7') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image7 = false;

        $removeImageFlag8 = (Input::has('removeImageFlag8')) ? Input::get('removeImageFlag8') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image8 = false;


        $removeImageFlag9 = (Input::has('removeImageFlag9')) ? Input::get('removeImageFlag9') : 0;
        $path = base_path() . '/public/item_images/';
        $remove_old_image9 = false;

        $removeImageFlag10 = (Input::has('removeImageFlag10')) ? Input::get('removeImageFlag10') : 0;
        $path2 = base_path() . '/public/size_images/';
        $remove_old_image10 = false;

        $image_file1 = DB::table('items')->where('id', $id)->value('image_url1');
        $image_file2 = DB::table('items')->where('id', $id)->value('image_url2');
        $image_file3 = DB::table('items')->where('id', $id)->value('image_url3');
        $image_file4 = DB::table('items')->where('id', $id)->value('image_url4');
        $image_file5 = DB::table('items')->where('id', $id)->value('image_url5');
        $image_file6 = DB::table('items')->where('id', $id)->value('image_url6');
        $image_file7 = DB::table('items')->where('id', $id)->value('image_url7');
        $image_file8 = DB::table('items')->where('id', $id)->value('image_url8');
        $image_file9 = DB::table('items')->where('id', $id)->value('image_url9');
        $image_file10 = DB::table('items')->where('id', $id)->value('image_url10');

        if (Input::hasFile('image_url1')) {
            //Start Saving Image
            $image_url1 = Input::file('image_url1');
            $image_url_name_original1 = Utility::getImage($image_url1);
            $image_url_ext1 = Utility::getImageExt($image_url1);
            $image_url_name1 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url1, $image_url_name1, $path);
            $remove_old_image1 = true;
            $image_files1 = '/item_images/' . $image_url_name1;
        //End Saving Image
        } else {
            if ($removeImageFlag1 == 1) {
                $image_files1 = "";
                $remove_old_image1 = true;

                $image_data=DB::select('SELECT image_url1 from items where id ='.$id);
                $image_path=$image_data[0]->image_url1;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files1=$image_file1;
            }
        }

        if (Input::hasFile('image_url2')) {
            //Start Saving Image
            $image_url2 = Input::file('image_url2');
            $image_url_name_original2 = Utility::getImage($image_url2);
            $image_url_ext2 = Utility::getImageExt($image_url2);
            $image_url_name2 = uniqid() . "." . $image_url_ext2;
            $image2 = Utility::resizeImage($image_url2, $image_url_name2, $path);
            $remove_old_image2 = true;
            $image_files2 = '/item_images/' . $image_url_name2;
        //End Saving Image
        } else {
            if ($removeImageFlag2 == 1) {
                $image_files2 = "";
                $remove_old_image2 = true;
                $image_data=DB::select('SELECT image_url2 from items where id ='.$id);
                $image_path=$image_data[0]->image_url2;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files2=$image_file2;
            }
        }

        if (Input::hasFile('image_url3')) {
            //Start Saving Image
            $image_url3 = Input::file('image_url3');
            $image_url_name_original3 = Utility::getImage($image_url3);
            $image_url_ext3 = Utility::getImageExt($image_url3);
            $image_url_name3 = uniqid() . "." . $image_url_ext3;
            $image3 = Utility::resizeImage($image_url3, $image_url_name3, $path);
            $remove_old_image3 = true;
            $image_files3 = '/item_images/' . $image_url_name3;
        //End Saving Image
        } else {
            if ($removeImageFlag3 == 1) {
                $image_files3 = "";
                $remove_old_image3 = true;
                $image_data=DB::select('SELECT image_url3 from items where id ='.$id);
                $image_path=$image_data[0]->image_url3;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files3=$image_file3;
            }
        }

        if (Input::hasFile('image_url4')) {
            //Start Saving Image
            $image_url4 = Input::file('image_url4');
            $image_url_name_original4 = Utility::getImage($image_url4);
            $image_url_ext4 = Utility::getImageExt($image_url4);
            $image_url_name4 = uniqid() . "." . $image_url_ext4;
            $image4 = Utility::resizeImage($image_url4, $image_url_name4, $path);
            $remove_old_image4 = true;
            $image_files4 = '/item_images/' . $image_url_name4;
        //End Saving Image
        } else {
            if ($removeImageFlag4 == 1) {
                $image_files4 = "";
                $remove_old_image4 = true;
                $image_data=DB::select('SELECT image_url4 from items where id ='.$id);
                $image_path=$image_data[0]->image_url4;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files4=$image_file4;
            }
        }

        if (Input::hasFile('image_url5')) {
            //Start Saving Image
            $image_url5 = Input::file('image_url5');
            $image_url_name_original5 = Utility::getImage($image_url5);
            $image_url_ext5 = Utility::getImageExt($image_url5);
            $image_url_name5 = uniqid() . "." . $image_url_ext5;
            $image5 = Utility::resizeImage($image_url5, $image_url_name5, $path);
            $remove_old_image5 = true;
            $image_files5 = '/item_images/' . $image_url_name5;
        //End Saving Image
        } else {
            if ($removeImageFlag5 == 1) {
                $image_files5 = "";
                $remove_old_image5 = true;
                $image_data=DB::select('SELECT image_url5 from items where id ='.$id);
                $image_path=$image_data[0]->image_url5;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files5=$image_file5;
            }
        }

        if (Input::hasFile('image_url6')) {
            //Start Saving Image
            $image_url6 = Input::file('image_url6');
            $image_url_name_original6 = Utility::getImage($image_url6);
            $image_url_ext6 = Utility::getImageExt($image_url6);
            $image_url_name6 = uniqid() . "." . $image_url_ext6;
            $image6 = Utility::resizeImage($image_url6, $image_url_name6, $path);
            $remove_old_image6 = true;
            $image_files6 = '/item_images/' . $image_url_name6;
        //End Saving Image
        } else {
            if ($removeImageFlag6 == 1) {
                $image_files6 = "";
                $remove_old_image6 = true;
                $image_data=DB::select('SELECT image_url6 from items where id ='.$id);
                $image_path=$image_data[0]->image_url6;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files6=$image_file6;
            }
        }

        if (Input::hasFile('image_url7')) {
            //Start Saving Image
            $image_url7 = Input::file('image_url7');
            $image_url_name_original7 = Utility::getImage($image_url7);
            $image_url_ext7 = Utility::getImageExt($image_url7);
            $image_url_name7 = uniqid() . "." . $image_url_ext7;
            $image7 = Utility::resizeImage($image_url7, $image_url_name7, $path);
            $remove_old_image7 = true;
            $image_files7 = '/item_images/' . $image_url_name7;
        //End Saving Image
        } else {
            if ($removeImageFlag7 == 1) {
                $image_files7 = "";
                $remove_old_image7 = true;
                $image_data=DB::select('SELECT image_url7 from items where id ='.$id);
                $image_path=$image_data[0]->image_url7;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files7=$image_file7;
            }
        }

        if (Input::hasFile('image_url8')) {
            //Start Saving Image
            $image_url8 = Input::file('image_url8');
            $image_url_name_original8 = Utility::getImage($image_url8);
            $image_url_ext8 = Utility::getImageExt($image_url8);
            $image_url_name8 = uniqid() . "." . $image_url_ext8;
            $image8 = Utility::resizeImage($image_url8, $image_url_name8, $path);
            $remove_old_image8 = true;
            $image_files8 = '/item_images/' . $image_url_name8;
        //End Saving Image
        } else {
            if ($removeImageFlag8 == 1) {
                $image_files8 = "";
                $remove_old_image8 = true;
                $image_data=DB::select('SELECT image_url8 from items where id ='.$id);
                $image_path=$image_data[0]->image_url8;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files8=$image_file8;
            }
        }

        if (Input::hasFile('image_url9')) {
            //Start Saving Image
            $image_url9 = Input::file('image_url9');
            $image_url_name_original9 = Utility::getImage($image_url9);
            $image_url_ext9 = Utility::getImageExt($image_url9);
            $image_url_name9 = uniqid() . "." . $image_url_ext9;
            $image9 = Utility::resizeImage($image_url9, $image_url_name9, $path);
            $remove_old_image9 = true;
            $image_files9 = '/item_images/' . $image_url_name9;
        //End Saving Image
        } else {
            if ($removeImageFlag9 == 1) {
                $image_files9 = "";
                $remove_old_image9 = true;
                $image_data=DB::select('SELECT image_url9 from items where id ='.$id);
                $image_path=$image_data[0]->image_url9;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files9=$image_file9;
            }
        }

        if (Input::hasFile('image_url10')) {
            //Start Saving Image
            $image_url10 = Input::file('image_url10');
            $image_url_name_original10 = Utility::getImage($image_url10);
            $image_url_ext10 = Utility::getImageExt($image_url10);
            $image_url_name10 = uniqid() . "." . $image_url_ext10;
            $image10 = Utility::resizeImage($image_url10, $image_url_name10, $path2);
            $remove_old_image10 = true;
            $image_files10 = '/size_images/' . $image_url_name10;
        //End Saving Image
        } else {
            if ($removeImageFlag10 == 1) {
                $image_files10 = "";
                $remove_old_image10 = true;
                $image_data=DB::select('SELECT image_url10 from items where id ='.$id);
                $image_path=$image_data[0]->image_url10;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files10=$image_file10;
            }
        }

        try{
            if($status == 2){
                $inactive_at          = date("Y-m-d");
                DB::update('update items set  name = ?, item_code = ?, categories_id = ?, countries_id = ?, brands_id = ?, profit_id = ?, url=?,image_url1 = ?, image_url2 = ?, image_url3 = ?, image_url4 = ?, image_url5 = ?, image_url6 = ?, image_url7 = ?, image_url8 = ?, image_url9 = ?, sale_type = ?, image_url10 = ?, description = ?, remark = ?, additional_charges = ?, shipping_fee = ?, purchase_price = ?, status = ?, inactive_at = ?, updated_at = ?, updated_by = ?, cargo_fee = ? where id = ?', [$name,$item_code,$categories_id,$countries_id,$brands_id,$profit_id,$url,$image_files1,$image_files2,$image_files3,$image_files4,$image_files5,$image_files6,$image_files7,$image_files8,$image_files9,$sale_type,$image_files10,$description,$remark,$additional_charges,$shipping_fee,$price,$status,$inactive_at,$updated_at,$updated_by,$cargo,$id]);
                DB::update('update items_specification set status = ?, updated_at = ?, updated_by = ? where items_id = ?', [$status,$updated_at,$updated_by,$id]);
                $message = 'Success, item updated successfully ...!';
                $request->session()->flash('success', $message);
                    return redirect()->action(
                        'backend\ItemController@index'
                    );
            }
            else{

            DB::update('update items set  name = ?, item_code = ?, categories_id = ?, countries_id = ?, brands_id = ?, profit_id = ?, url = ?,image_url1 = ?, image_url2 = ?, image_url3 = ?, image_url4 = ?, image_url5 = ?, image_url6 = ?, image_url7 = ?, image_url8 = ?, image_url9 = ?, sale_type = ?, image_url10 = ?, description = ?, remark = ?, additional_charges = ?, shipping_fee = ?, purchase_price = ?, status = ?, updated_at = ?, updated_by = ?, cargo_fee = ? where id = ?', [$name,$item_code,$categories_id,$countries_id,$brands_id,$profit_id,$url,$image_files1,$image_files2,$image_files3,$image_files4,$image_files5,$image_files6,$image_files7,$image_files8,$image_files9,$sale_type,$image_files10,$description,$remark,$additional_charges,$shipping_fee,$price,$status,$updated_at,$updated_by,$cargo,$id]);
            DB::update('update items_specification set status = ?, updated_at = ?, updated_by = ? where items_id = ?', [$status,$updated_at,$updated_by,$id]);

            if ($remove_old_image1 == true) {
                Utility::removeImage($image_file1);
            }
            if ($remove_old_image2 == true) {
                Utility::removeImage($image_file2);
            }
            if ($remove_old_image3 == true) {
                Utility::removeImage($image_file3);
            }
            if ($remove_old_image4 == true) {
                Utility::removeImage($image_file4);
            }
            if ($remove_old_image5 == true) {
                Utility::removeImage($image_file5);
            }
            if ($remove_old_image6 == true) {
                Utility::removeImage($image_file6);
            }
            if ($remove_old_image7 == true) {
                Utility::removeImage($image_file7);
            }
            if ($remove_old_image8 == true) {
                Utility::removeImage($image_file8);
            }
            if ($remove_old_image9 == true) {
                Utility::removeImage($image_file9);
            }
            if ($remove_old_image10 == true) {
                Utility::removeImage($image_file10);
            }

            $items_id = $request->input('id');
            if($items_id == null){
                $message = 'Success, item updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\ItemController@index'
                );

            }
            else{

            $items_id = $request->input('id');
            $size = $request->input('size');
            $color = $request->input('color');
            $qty = $request->input('qty');
            $item_count=count($items_id);


            for($i=0; $i<$item_count; $i++)
            {
                $item = $items_id[$i];
                $item_specifications = DB::table('items_specification')->where('id', $item)->get();
                $old_size = $item_specifications[0]->size;
                $old_color =  $item_specifications[0]->color;
                $old_qty = $item_specifications[0]->qty;
                $s    = $size[$i];
                $c    = $color[$i];
                $q    = abs($qty[$i]);

                DB::insert('insert into log (items_id,items_specification_id,old_size,size,old_color,color,old_qty,qty,old_price,price,old_remark,remark,updated_at,updated_by) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [$id,$item, $old_size,$s,$old_color,$c,$old_qty,$q,$old_price,$p,$old_remark,$r,$updated_at,$updated_by]);

                DB::update('update items_specification set size = ?, color = ?, qty = ?, updated_at = ?, updated_by = ? where id = ?', [$s,$c,$q,$updated_at,$updated_by,$item]);


            }
        }
            $message = 'Success, item updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\ItemController@index'
                );

        }
    }
        catch(Exception $e){

            $smessage = 'Fail, Error in item updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\CategoryController@index'
            );

    }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request,$id)
    {
        $id = Crypt::decrypt($id);
        $items=DB::select('SELECT * from items where id = '.$id);
        $sale_type = $items[0]->sale_type;
        if($sale_type == 0){
            return view('backend_v2.item_specification.create')
            ->with('items',$items);
        }
        else{
            return view('backend_v2.item_specification.create_preorder')
            ->with('items',$items);
        }

    }
    public function archive()
    {
        //

        $items = DB::select('SELECT i.* , c.name as category_name , b.name as brand_name , co.name as country_name
                        from items as i
                        JOIN categories as c
                        ON i.categories_id = c.id
                        JOIN countries as co
                        ON i.countries_id = co.id
                        JOIN brands as b
                        ON i.brands_id = b.id
                        Where i.status=0');


        return view('backend_v2.item.archive')
            ->with('items', $items);

    }
    public function inactive()
    {
        //

        $items = DB::select('SELECT i.* , c.name as category_name , b.name as brand_name , co.name as country_name
                        from items as i
                        JOIN categories as c
                        ON i.categories_id = c.id
                        JOIN countries as co
                        ON i.countries_id = co.id
                        JOIN brands as b
                        ON i.brands_id = b.id
                        Where i.status=2');


        return view('backend_v2.item.inactive')
            ->with('items', $items);

    }
    public function activate(Request $request)
    {
        //
        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least an item!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\ItemController@archive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("items")->where('id',$ids)->update(['status' => 1]);
        DB::table("items_specification")->where('items_id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, item and item_specification activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\ItemController@archive');
        }
    }
    public function activechange(Request $request)
    {
        //
        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least an item!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\ItemController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("items")->where('id',$ids)->update(['status' => 1]);
        DB::table("items")->where('id',$ids)->update(['inactive_at' => NULL]);
        DB::table("items_specification")->where('items_id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, item and item_specification activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\ItemController@inactive');
        }
    }
    public function delete($id){

        $id = Crypt::decrypt($id);
        $items = DB::table('items')->where('id', $id)->first();
        $item_specifications = DB::table('items_specification')->where('items_id', $id)->get();

        return view('backend_v2.item.delete', ['items' => $items,'item_specifications' => $item_specifications]);

    }
}
