<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Order_detail;
use App\Order;
use Illuminate\Support\Facades\Input;

class PreOrderStatusController extends Controller
{
    public function cancel(Request $request,$id){

        $id = Crypt::decrypt($id);
        $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
        $order_id= $details[0]->order_id;

        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $status = 2;









                DB::update('update orders set status = ? , updated_by = ? where id = ?',[$status,$updated_by,$order_id]);



                $message = 'Success, order cancelled successfully ...!';
                $request->session()->flash('success', $message);

                return redirect()->action(
                    'backend\PreOrderController@to'
                );



    }
    public function confirm(Request $request,$id){

       $id = Crypt::decrypt($id);
        $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
        $order_id= $details[0]->order_id;

        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $status = 0;


        $updated_at          = date("Y-m-d H:i:s");



            DB::update('update orders set status = ? , updated_by = ? where id = ?',[$status,$updated_by,$order_id]);

            $message = 'Success, order confirmed successfully ...!';
            $request->session()->flash('success', $message);

            return redirect()->action(
                'backend\PreOrderController@to'
            );

    }
    // public function cancel_preordered(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 2;


    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order cancelled successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@preordered'
    //         );

    // }
    // public function confirm_preordered(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 0;


    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order confirmed successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@preordered'
    //         );

    // }
    // public function cancel_received(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 2;
    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order cancelled successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@receive'
    //         );

    // }
    // public function confirm_received(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 0;
    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order confirmed successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@receive'
    //         );

    // }
    // public function cancel_delivered(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 2;
    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order cancelled successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@deliver'
    //         );

    // }
    // public function confirm_delivered(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 0;


    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order confirmed successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@deliver'
    //         );

    // }
    // public function cancel_completed(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 2;
    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order cancelled successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@completed'
    //         );

    // }
    // public function confirm_completed(Request $request,$id){

    //     $id = Crypt::decrypt($id);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;

    //     $status = 0;


    //     $updated_at          = date("Y-m-d H:i:s");



    //         DB::update('update orders set status = ? , updated_by = ?,  updated_at = ? where id = ?',[$status,$updated_by,$updated_at,$id]);

    //         $message = 'Success, order confirmed successfully ...!';
    //         $request->session()->flash('success', $message);

    //         return redirect()->action(
    //             'backend\PreOrderController@completed'
    //         );

    // }
    public function detail_t($id){
        $id = Crypt::decrypt($id);
        
        $preorders = DB::select('SELECT o.*,ord.*,o.id as id,spec.size,spec.color,i.url, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
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

     return view('backend_v2.preorder.detail_t')
     ->with('preorders',$preorders)
     ->with('banks',$banks)
     ->with('image',$image);


    }

    public function detail_p($id){
        $id = Crypt::decrypt($id);

        $preorders = DB::select('SELECT o.*,ord.*,o.id as id,spec.size,spec.color,i.url, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
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

     return view('backend_v2.preorder.detail_p')
     ->with('preorders',$preorders)
     ->with('banks',$banks)
     ->with('image',$image);


    }
    public function detail_r($id){
        $id = Crypt::decrypt($id);

        $preorders = DB::select('SELECT o.*,ord.*,o.id as id,spec.size,spec.color,i.url, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
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

     return view('backend_v2.preorder.detail_r')
     ->with('preorders',$preorders)
     ->with('banks',$banks)
     ->with('image',$image);


    }
    public function detail_d($id){
        $id = Crypt::decrypt($id);

        $preorders = DB::select('SELECT o.*,ord.*,o.id as id,spec.size,spec.color,i.url, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
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

     return view('backend_v2.preorder.detail_d')
     ->with('preorders',$preorders)
     ->with('banks',$banks)
     ->with('image',$image);


    }
    public function detail_c($id){
        $id = Crypt::decrypt($id);

        $preorders = DB::select('SELECT o.*,ord.*,o.id as id,spec.size,spec.color,i.url, i.item_code as item_code,ord.preordered_date as preordered_date,ord.received_date as received_date,ord.delivered_date as delivered_date
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
     return view('backend_v2.preorder.detail_c')
     ->with('preorders',$preorders)
     ->with('banks',$banks)
     ->with('image',$image);


    }
    public function change_1(Request $request)
    {
        //
        $ids = Input::get('o_id');
        $remark = Input::get('remark');
        if($remark == null){
         $message = 'You need to input remark';
         $request->session()->flash('fail', $message);

         return redirect()->action(
            'backend\PreOrderController@to'
        );

        }
        else{

            DB::table("orders")->where('id',$ids)->update(['remark' => $remark]);


        }

         $message = 'Success, remark updated successfully ...!';
         $request->session()->flash('success', $message);
         return redirect()->action(
            'backend\PreOrderController@to');
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
                 'backend\PreOrderController@preordered'
             );

             }
             else{

                 DB::table("orders")->where('id',$ids)->update(['remark' => $remark]);


             }

              $message = 'Success, remark updated successfully ...!';
              $request->session()->flash('success', $message);
              return redirect()->action(
                 'backend\PreOrderController@preordered');
              }
              public function change_3(Request $request)
              {
                  //
                  $ids = Input::get('o_id');
                  $remark = Input::get('remark');
                  if($remark == null){
                   $message = 'You need to input remark';
                   $request->session()->flash('fail', $message);

                   return redirect()->action(
                      'backend\PreOrderController@receive'
                  );

                  }
                  else{

                      DB::table("orders")->where('id',$ids)->update(['remark' => $remark]);


                  }

                   $message = 'Success, remark updated successfully ...!';
                   $request->session()->flash('success', $message);
                   return redirect()->action(
                      'backend\PreOrderController@receive');
                   }

        public function change_4(Request $request)
                   {
                       //
                       $ids = Input::get('o_id');
                       $remark = Input::get('remark');
                       if($remark == null){
                        $message = 'You need to input remark';
                        $request->session()->flash('fail', $message);

                        return redirect()->action(
                           'backend\PreOrderController@deliver'
                       );

                       }
                       else{

                           DB::table("orders")->where('id',$ids)->update(['remark' => $remark]);


                       }

                        $message = 'Success, remark updated successfully ...!';
                        $request->session()->flash('success', $message);
                        return redirect()->action(
                           'backend\PreOrderController@deliver');
                        }
            public function change_5(Request $request)
                   {
                       //
                       $ids = Input::get('o_id');
                       $remark = Input::get('remark');
                       if($remark == null){
                        $message = 'You need to input remark';
                        $request->session()->flash('fail', $message);

                        return redirect()->action(
                           'backend\PreOrderController@completed'
                       );

                       }
                       else{

                           DB::table("orders")->where('id',$ids)->update(['remark' => $remark]);


                       }

                        $message = 'Success, remark updated successfully ...!';
                        $request->session()->flash('success', $message);
                        return redirect()->action(
                           'backend\PreOrderController@completed');
                        }
}