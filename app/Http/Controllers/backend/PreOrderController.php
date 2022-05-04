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
class PreOrderController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function to()
    {
        $preorders = DB::select('SELECT o.*,od.order_id as order_id,od.quantity as qty,od.price as price,od.sub_total as total, i.item_code as item_code,i.sale_type as sale_type,  u.name as customer_name,i.image_url1 as image_url1
                            from orders as o
                            JOIN orders_detail as od
                            ON o.id=od.order_id
                            JOIN items as i
                            ON od.item_id=i.id
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null
                            and o.preorder_status = 1
                            and i.sale_type = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');


        $delete = DB::select('SELECT o.id,o.status from orders as o
        Where o.status = 0 and curdate() > DATE_ADD(o.updated_at, interval 2 MONTH)');

        $order_s = DB::select('SELECT od.id
        from orders_detail as od
        join orders as o
        on o.id = od.order_id
        Where o.status = 0
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



        return view('backend_v2.preorder.topreorder')
        ->with('users',$users)
        ->with('preorders',$preorders);

    }

    public function deliver()
    {
        $preorders = DB::select('SELECT o.*,od.order_id as order_id,od.quantity as qty,od.price as price,od.sub_total as total, i.item_code as item_code,i.sale_type as sale_type,  u.name as customer_name,i.image_url1 as image_url1
                            from orders as o
                            JOIN orders_detail as od
                            ON o.id=od.order_id
                            JOIN items as i
                            ON od.item_id=i.id
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null
                            and o.status = 3
                            and i.sale_type = 1');

        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.preorder.deliver')
        ->with('users',$users)
        ->with('preorders',$preorders);

    }

    public function receive()
    {
        $preorders = DB::select('SELECT o.*,od.order_id as order_id,od.quantity as qty,od.price as price,od.sub_total as total, i.item_code as item_code,i.sale_type as sale_type,  u.name as customer_name,i.image_url1 as image_url1
                            from orders as o
                            JOIN orders_detail as od
                            ON o.id=od.order_id
                            JOIN items as i
                            ON od.item_id=i.id
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null
                            and o.preorder_status = 3
                            and o.status < 3
                            and i.sale_type = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.preorder.receive')
        ->with('users',$users)
        ->with('preorders',$preorders);

    }

    public function preordered()
    {
        $preorders = DB::select('SELECT o.*,od.order_id as order_id,od.quantity as qty,od.price as price,od.sub_total as total, i.item_code as item_code,i.sale_type as sale_type,  u.name as customer_name,i.image_url1 as image_url1
                            from orders as o
                            JOIN orders_detail as od
                            ON o.id=od.order_id
                            JOIN items as i
                            ON od.item_id=i.id
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null
                            and o.preorder_status = 2
                            and i.sale_type = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.preorder.preordered')
        ->with('users',$users)
        ->with('preorders',$preorders);

    }

    public function completed()
    {
        $preorders = DB::select('SELECT o.*,od.order_id as order_id,od.quantity as qty,od.price as price,od.sub_total as total, i.item_code as item_code,i.sale_type as sale_type,  u.name as customer_name,i.image_url1 as image_url1
                            from orders as o
                            JOIN orders_detail as od
                            ON o.id=od.order_id
                            JOIN items as i
                            ON od.item_id=i.id
                            JOIN users as u
                            ON o.user_id=u.id
                            where o.deleted_at is null
                            and o.status = 4
                            and i.sale_type = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.preorder.completed')
        ->with('users',$users)
        ->with('preorders',$preorders);

    }

    public function change(Request $request,$id)
    {
       
        $tdy = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
        $order_id= $details[0]->order_id;

         
         
        DB::table("orders")->where('id',$order_id)->update(['preorder_status' => 2,'preordered_date' => $tdy]);
       


        $message = 'Success,pre orders changed preordered successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\PreOrderController@to');
        }
    



    public function change_2(Request $request,$id)
    {
        //
        $tdy = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
        $order_id= $details[0]->order_id;

         DB::table("orders")->where('id',$order_id)->update(['preorder_status' => 3,'received_date' => $tdy]);

        


         $message = 'Success,pre orders changed to receive successfully ...!';
         $request->session()->flash('success', $message);
         return redirect()->action(
            'backend\PreOrderController@preordered');
         

    }
    public function change_3(Request $request,$id)
    {
        //
        $tdy = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
        $order_id= $details[0]->order_id;

         DB::table("orders")->where('id',$order_id)->update(['status' => 3,'delivered_date' => $tdy]);

        


         $message = 'Success,pre orders changed to deliver successfully ...!';
         $request->session()->flash('success', $message);
         return redirect()->action(
            'backend\PreOrderController@receive');
         

    }
    public function change_4(Request $request,$id)
    {
        //
        $tdy = date("Y-m-d H:i:s");
        $id = Crypt::decrypt($id);
        $details = DB::select('SELECT order_id from orders_detail where id = '.$id);
        $order_id= $details[0]->order_id;

         DB::table("orders")->where('id',$order_id)->update(['status' => 4,'updated_at' => $tdy]);

        


         $message = 'Success,pre orders changed to completed successfully ...!';
         $request->session()->flash('success', $message);
         return redirect()->action(
            'backend\PreOrderController@deliver');
         

    }



}