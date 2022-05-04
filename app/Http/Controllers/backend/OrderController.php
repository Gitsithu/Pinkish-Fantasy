<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\ReturnMessage as ReturnMessage;
use App\Order_detail;
use App\Order;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use App\Core\Item;
use App\Core\Delivery;
use App\Core\Utility as Utility;


class OrderController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function no()
    {

        $banks = DB::select('SELECT * from banks_info');

        $delete = DB::select('SELECT o.id,o.status from orders as o
        Where o.status = 2 and curdate() > DATE_ADD(o.updated_at, interval 2 MONTH)');

        $order_s = DB::select('SELECT od.id
        from orders_detail as od
        join orders as o
        on o.id = od.order_id
        Where o.status = 2
        and curdate() > DATE_ADD(o.updated_at, interval 2 MONTH)');

        $d_count = count($delete);

        $order_s_count = count($order_s);

        for($j=0;$j<$order_s_count;$j++){
        $order_s_d = $order_s[$j]->id;

        $od_delete =Order_detail::find($order_s_d);
        $od_delete->forceDelete();
        }
        for($i=0;$i<$d_count;$i++){
        $f = $delete[$i]->id;

        $order = Order::find($f);
        $order->forceDelete();

        }

        $orders = DB::select('SELECT o.*, u.name as name
                            from orders as o
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null');

        $orders2 = DB::select('SELECT o.*,od.order_id as order_id, i.item_code as item_code,i.sale_type as sale_type, u.name as name,i.image_url1 as image_url1
                            from orders_detail as od
                            JOIN orders as o
                            ON o.id=od.order_id
                            JOIN items as i
                            ON od.item_id=i.id
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null
                            and i.sale_type= 0
                            and o.status < 3 
                            ORDER BY od.id desc');
       
        $users = DB::select('SELECT * from users where deleted_at is null');



        return view('backend_v2.order.no_payment')
        ->with('users',$users)
        ->with('orders2',$orders2)
        ->with('orders',$orders)
        ->with('banks',$banks);
        

    }
    public function deliver()
    {

        $orders = DB::select('SELECT o.*,od.order_id as order_id, i.item_code as item_code,i.sale_type as sale_type, u.name as name,i.image_url1 as image_url1
        from orders_detail as od
        JOIN orders as o
        ON o.id=od.order_id
        JOIN items as i
        ON od.item_id=i.id
        JOIN users as u
        ON o.user_id=u.id
        where o.deleted_at is null
        and i.sale_type= 0
        and o.status = 3
        ORDER BY od.id desc');
         $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.order.delivered')
        ->with('users',$users)
        ->with('orders',$orders);

    }


    public function complete()
    {
        $orders = DB::select('SELECT o.*,od.order_id as order_id, i.item_code as item_code,i.sale_type as sale_type, u.name as name,i.image_url1 as image_url1
        from orders_detail as od
        JOIN orders as o
        ON o.id=od.order_id
        JOIN items as i
        ON od.item_id=i.id
        JOIN users as u
        ON o.user_id=u.id
        where o.deleted_at is null
        and i.sale_type= 0
        and o.status = 4
        ORDER BY od.id desc');
         $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.order.completed')
        ->with('users',$users)
        ->with('orders',$orders);

    }


    public function change_2(Request $request)
    {
        //
        $ids = Input::get('o_id');
        $remark = Input::get('remark');
        if($remark == null){
         $message = 'You need to input remark';
         $request->session()->flash('fail', $message);

         return redirect()->action(
            'backend\OrderController@no'
        );

        }
        else{

            DB::table("orders")->where('id',$ids)->update(['remark' => $remark]);


        }

         $message = 'Success, remark updated successfully ...!';
         $request->session()->flash('success', $message);
         return redirect()->action(
            'backend\OrderController@no');
         }

    public function make_deliver(Request $request,$id)
         {
            $id = Crypt::decrypt($id);
            $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
            $order_id= $details[0]->order_id;

             
             
                 DB::table("orders")->where('id',$order_id)->update(['status' => 3]);
     
     
             
     
              $message = 'Success, orders changed to delivered successfully ...!';
              $request->session()->flash('success', $message);
              return redirect()->action(
                 'backend\OrderController@no');
              }

    public function make_complete(Request $request,$id)
         {
            $id = Crypt::decrypt($id);
            $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
            $order_id= $details[0]->order_id;

             
             
                 DB::table("orders")->where('id',$order_id)->update(['status' => 4]);
     
     
             
     
              $message = 'Success, orders changed to completed successfully ...!';
              $request->session()->flash('success', $message);
              return redirect()->action(
                 'backend\OrderController@deliver');
              }
     

    public function detail($id){
        $id = Crypt::decrypt($id);

        $orders = DB::select('SELECT o.*,ord.*,o.id as id,spec.size,spec.color, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
                            from orders_detail as o
                            join orders as ord
                            on ord.id = o.order_id
                            join items as i
                            on o.item_id = i.id
                            join items_specification spec
                            on spec.id=o.specification_id
                            where o.order_id='.$id);
         $images = DB::select('SELECT ord.payment_screenshot as image
         from orders_detail as o
         join orders as ord
         on o.order_id = ord.id
         where o.order_id='.$id);
         $image = $images[0]->image;
         
         $banks = DB::select('SELECT * from banks_info');

     return view('backend_v2.order.detail')
     ->with('orders',$orders)
     ->with('banks',$banks)
     ->with('image',$image);


    }

    public function detail_d($id){
        $id = Crypt::decrypt($id);

        $orders = DB::select('SELECT o.* ,ord.*,o.id as id,ord.status as status,spec.size,spec.color, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
                            from orders_detail as o
                            join orders as ord
                            on ord.id = o.order_id
                            join items as i
                            on o.item_id = i.id
                            join items_specification spec
                            on spec.id=o.specification_id
                            where o.order_id='.$id);
          $images = DB::select('SELECT ord.payment_screenshot as image
          from orders_detail as o
          join orders as ord
          on o.order_id = ord.id
        join items_specification spec
        on spec.id=o.specification_id
          where o.order_id='.$id);
         $image = $images[0]->image;
      
         $banks = DB::select('SELECT * from banks_info');

     return view('backend_v2.order.detail_d')
     ->with('orders',$orders)
     ->with('banks',$banks)
     ->with('image',$image);


    }

    public function detail_c($id){
        $id = Crypt::decrypt($id);

        $orders = DB::select('SELECT o.* ,ord.*,o.id as id,ord.status as status,spec.size,spec.color, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
                            from orders_detail as o
                            join orders as ord
                            on ord.id = o.order_id
                            join items as i
                            on o.item_id = i.id
                            join items_specification spec
                            on spec.id=o.specification_id
                            where o.order_id='.$id);
         $images = DB::select('SELECT ord.payment_screenshot as image
         from orders_detail as o
         join orders as ord
         on o.order_id = ord.id
         where o.order_id='.$id);
         $image = $images[0]->image;

         $banks = DB::select('SELECT * from banks_info');

     return view('backend_v2.order.detail_c')
     ->with('orders',$orders)
     ->with('banks',$banks)
     ->with('image',$image);


    }

    public function create(){

        $items = DB::select('SELECT id , item_code from items where status = 1');
        $banks = DB::select('SELECT * from banks_info');
        $townships = DB::select('SELECT id ,township from delivery where division = 1');

        return view('backend_v2.order.create')
        ->with('townships',$townships)
        ->with('items',$items)
        ->with('banks',$banks);
        
    }
    public function store(Request $request){

        $this->validate($request, [
            'item_id'               => 'required',
            'items_spec_id'         => 'required',
            'quantity'              => 'required|min:1',
            'contact_name'          => 'required',
            'order_date'            => 'required|after:yesterday',
            'contact_phone'         => 'required',
            'delivery_id'           => 'required',
            'delivery_address'      => 'required|max:255',
            'payment_type'          => 'required',
            'bank_id'               => 'required',

     ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;
        $created_role = $loginUser->role_id;

        $image_url_name = "";
        //Start Saving Image
        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/payment_images/';

        if (Input::hasFile('payment_screenshot')) {
            $image_url = Input::file('payment_screenshot');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
        } else {
            $image_url_name = "";
        }

        if ($removeImageFlag == 1) {
            $image_url_name = "";
        }
        //End Saving Image 1
        $image_file = '/payment_images/' . $image_url_name;
        $item_id       = $request->input('item_id');
        if($item_id == 0)
        {
            $smessage = 'Pls, select an item code instead of this ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\OrderController@create'
            );
        }
        $items_spec_id        = $request->input('items_spec_id');
        $quantity           = $request->input('quantity');
        $email           = $request->input('email');
        $contact_name           = $request->input('contact_name');
        $order_date              = $request->input('order_date');
        $contact_phone                 = $request->input('contact_phone');
        $delivery_address         = $request->input('delivery_address');
        $township_id         = $request->input('township_id');
        $bank_id         = $request->input('bank_id');
        $payment_type         = $request->input('payment_type');

        $delivery_cost=DB::table("delivery")->where('id','=',$township_id)->value('charges');


        $data = DB::table('items')
                ->where('items.id',$item_id)
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

        $saleprice2 = $saleprice;
        $saleprice = $saleprice * $quantity;

        $sale_type=DB::table("items")->where('id','=',$item_id)->value('sale_type');

        if($sale_type == 0){
            $preorder_status = 3;
            $qty=DB::table("items_specification")->where('id','=',$items_spec_id)->value('qty');

            $difference = $qty - $quantity;

            if ($difference >= 0){
                DB::update('update items_specification set qty = ? where id = ?',[$difference,$items_spec_id]);
            }
            else{
                $smessage = 'Sorry, Instock item does not have enough quantity ...!';
                $request->session()->flash('fail', $smessage);

                return redirect()->action(
                    'backend\OrderController@create'
                );
            }
        }
        else{
            $preorder_status = 1;
        }

        $created_at          = date("Y-m-d H:i:s");
         // generating customized order id
         $date = Carbon::now();
         $data_count = Order::count();
         $last_id_count = $data_count + 1;
         $id_length = strlen($last_id_count);
         $id_total_length = 6 - $id_length;
         $last_data_id = str_replace("-", "", $date->toDateString());
         for ($i = 0; $i < $id_total_length; $i++) {
             $last_data_id .= '0';
         }
         $last_data_id .= $last_id_count;
         // generating customized order id


         $data2 = DB::table('items')
         ->where('items.id',$item_id)
         ->select('items.categories_id','items.brands_id')
         ->first();
         $promotion = DB::table('promotion')
                    ->where('product_status','<=',2)
                    ->where('promotion.start_date','<=',Carbon::today()->toDateString())
			        ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                    ->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
                    ->where('promotion_detail.product_id',$data2->categories_id)
                    ->select('promotion.promo_amount','promotion.promo_percent')
                    ->first();

        if($promotion == []){
            $promotion = DB::table('promotion')
            ->where('product_status',3)
            ->where('promotion.start_date','<=',Carbon::today()->toDateString())
            ->where('promotion.end_date','>=',Carbon::today()->toDateString())
            ->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
            ->where('promotion_detail.product_id',$item_id)
            ->select('promotion.promo_amount','promotion.promo_percent')
            ->first();
            if($promotion == []){
                $promotion = DB::table('promotion')
                ->where('product_status',4)
                ->where('promotion.start_date','<=',Carbon::today()->toDateString())
                ->where('promotion.end_date','>=',Carbon::today()->toDateString())
                ->leftJoin('promotion_detail','promotion_detail.p_id','promotion.id')
                ->where('promotion_detail.product_id',$data2->brands_id)
                ->select('promotion.promo_amount','promotion.promo_percent')
                ->first();
                if($promotion == []){
                    $final_cost= $saleprice + $delivery_cost;

                }
            }
        }
        if($promotion!=[]){


        if($promotion->promo_amount == null) {
            $discount_price = $saleprice - ($saleprice * ($promotion->promo_percent/100));
            $discount_price = (int)round($discount_price);
            $sub=substr($discount_price,-3,3);
            if($sub == 000 || $sub== 500) {
                $discount_price;
            } elseif($sub < 500) {
                $discount_price = substr_replace($discount_price,500,-3,3);
            } else {
                $discount_price += 1000;
                $minus = substr($discount_price,-3,3);
                $discount_price -= $minus;
            }
            $discount_price = $discount_price;
        } else {
            $discount_price = $saleprice - $promotion->promo_amount;
        }
        $final_cost= $discount_price + $delivery_cost;
        }
        try{

        DB::insert('insert into orders (id,user_id,order_date,customer_name,delivery_address,delivery_id,phone,email,total_quantity,delivery_cost,final_cost,payment_type,bank_id,payment_screenshot,preorder_status,created_by,created_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$last_data_id,$created_by,$order_date,$contact_name,$delivery_address,$township_id,$contact_phone,$email,$quantity,$delivery_cost,$final_cost,$payment_type,$bank_id,$image_file,$preorder_status,$created_role,$created_at]);

        DB::insert('insert into orders_detail (order_id,item_id,specification_id,quantity,price,sub_total,created_at) values(?,?,?,?,?,?,?)',
        [$last_data_id,$item_id,$items_spec_id,$quantity,$saleprice2,$final_cost,$created_at]);


                $message = 'Success, order created successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\OrderController@no'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in order creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\OrderController@create'
            );
        }
    }
    public function getSpecByItem(Request $request)
    {



        try {
            $inputs = Input::all();
            $request_conditions = isset($inputs['conditions']) ? $inputs['conditions'] : null;
            $raw_conditions = json_decode($request_conditions);

            $conditions = array();
            foreach ($raw_conditions as $key => $value) {
                $conditions[$key] = $value;
            }

            // getting data by array format
            $raw_data      = Item::getSpecsByConditions($conditions);

            $result_array = array();
            $result_array['result_array'] = $raw_data;

            $raw_objs = $raw_data;
            $item_list = "";






            foreach ($raw_objs as $item) {

                $item_list .= '<option value="'. $item->id .'" style="color:'.$item->color.';text-rendering:optimizeLegibility;">Size = '. $item->size. ' Color = &#xf0a3;</option>';

            }


            $returned_obj['objs'] = $item_list;

            $returned_obj['status_code'] = ReturnMessage::OK;
            $returned_obj['status_message'] = "Syncs down process completed successfully !";
            $returned_obj['data'] = $result_array;


            return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::OK);
        } catch (\Exception $e) {
            $returned_obj['status_code'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returned_obj['status_message'] = $e->getMessage();
            $returned_obj['data'] = array();
            $returned_obj['objs'] = "";

            return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
        }
        public function cancel(Request $request,$id){

            $ids = Crypt::decrypt($id);
            $details = DB::select('SELECT order_id from orders_detail where id = '.$ids);
            $id= $details[0]->order_id;

            $loginUser = Auth::user();
            $updated_by = $loginUser->id;

            $status = 2;

            $item_id=DB::table("orders_detail")->where('order_id','=',$id)->value('item_id');
            $items_spec_id=DB::table("orders_detail")->where('order_id','=',$id)->value('specification_id');

            $sale_type=DB::table("items")->where('id','=',$item_id)->value('sale_type');
            $updated_at          = date("Y-m-d H:i:s");

            if($sale_type == 0){
                $quantity = DB::table("items_specification")->where('id','=',$items_spec_id)->value('qty');
                $qty = DB::table("orders_detail")->where('order_id','=',$id)->value('quantity');
                $plus = $qty + $quantity;


                    DB::update('update items_specification set qty = ? where id = ?',[$plus,$items_spec_id]);
                    DB::update('update orders set status = ? , updated_by = ?, updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);
                    


                    $message = 'Success, order cancelled successfully ...!';
                    $request->session()->flash('success', $message);

                    return redirect()->action(
                        'backend\OrderController@no'
                    );
                }

            else{

                DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

                $message = 'Success, order cancelled successfully ...!';
                $request->session()->flash('success', $message);

                return redirect()->action(
                    'backend\OrderController@no'
                );
            }
        }
        public function confirm(Request $request,$id){

            $ids = Crypt::decrypt($id);
            $details = DB::select('SELECT order_id from orders_detail where id = '.$ids);
            $id= $details[0]->order_id;

            $loginUser = Auth::user();
            $updated_by = $loginUser->id;

            $status = 0;

            $item_id=DB::table("orders_detail")->where('order_id','=',$id)->value('item_id');
            $items_spec_id=DB::table("orders_detail")->where('order_id','=',$id)->value('specification_id');

            $sale_type=DB::table("items")->where('id','=',$item_id)->value('sale_type');
            $updated_at          = date("Y-m-d H:i:s");

            if($sale_type == 0){
                $quantity = DB::table("items_specification")->where('id','=',$items_spec_id)->value('qty');
                $qty = DB::table("orders_detail")->where('order_id','=',$id)->value('quantity');
                


                    
                    DB::update('update orders set status = ? , updated_by = ?, updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);
                    


                    $message = 'Success, order confirmed successfully ...!';
                    $request->session()->flash('success', $message);

                    return redirect()->action(
                        'backend\OrderController@no'
                    );
                }

            else{

                DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

                $message = 'Success, order confirmed successfully ...!';
                $request->session()->flash('success', $message);

                return redirect()->action(
                    'backend\OrderController@no'
                );
            }
        }
        public function getTownshipByDivision(Request $request)
        {



            try {
                $inputs = Input::all();
                $request_conditions = isset($inputs['conditions']) ? $inputs['conditions'] : null;
                $raw_conditions = json_decode($request_conditions);

                $conditions = array();
                foreach ($raw_conditions as $key => $value) {
                    $conditions[$key] = $value;
                }

                // getting data by array format
                $raw_data      = Delivery::getTownshipsByConditions($conditions);

                $result_array = array();
                $result_array['result_array'] = $raw_data;

                $raw_objs = $raw_data;
                $item_list = "";






                foreach ($raw_objs as $item) {

                    $item_list .= '<option value="'. $item->id .'">'. $item->township.'</option>';

                }


                $returned_obj['objs'] = $item_list;

                $returned_obj['status_code'] = ReturnMessage::OK;
                $returned_obj['status_message'] = "Syncs down process completed successfully !";
                $returned_obj['data'] = $result_array;


                return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::OK);
            } catch (\Exception $e) {
                $returned_obj['status_code'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returned_obj['status_message'] = $e->getMessage();
                $returned_obj['data'] = array();
                $returned_obj['objs'] = "";

                return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::INTERNAL_SERVER_ERROR);
            }
            }

        }