<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use PDF;
use Excel;
use App\Order_detail;
use App\Order;
use Illuminate\Support\Facades\Input;
use App\Export\OrderSummaryView;


class OrderReportController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = DB::select('SELECT o.*,od.quantity as qty,od.price as price,od.sub_total as total, i.item_code as item_code,i.sale_type as sale_type, u.name as name
        from orders as o
        JOIN orders_detail as od
        ON o.id=od.order_id
        JOIN items as i
        ON od.item_id=i.id
        JOIN users as u
        ON o.user_id=u.id
        where o.deleted_at is null ');
        $users = DB::select('SELECT * from users where deleted_at is null');

        $from_date=null;
        $to_date=null;
        $type=0;

        $delete = DB::select('SELECT o.id,o.status from orders as o
        Where o.status =0 and curdate() > DATE_ADD(o.updated_at, interval 2 MONTH)');

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



        return view('backend_v2.report.order_report')
        ->with('users',$users)
        ->with('from_date',$from_date)
        ->with('to_date',$to_date)
        ->with('type',$type)
        ->with('orders',$orders);



    }
    public function search(Request $request)
    {
        $button    = $request->input('button');
        $from_date = $request->input('from_date');
        $to_date   = $request->input('to_date');
        $type      = $request->input('preorder_status');
        if($type==0){
        if($from_date == null && $to_date == null){
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('orders_detail','orders.id','=','orders_detail.order_id')
                    ->join('items','orders_detail.item_id','=','items.id')
                    ->select('users.name', 'items.image_url1','items.sale_type', 'items.item_code','orders_detail.*', 'orders.*')->get();

        }
        elseif($from_date == null){
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
            ->join('orders_detail','orders.id','=','orders_detail.order_id')
            ->join('items','orders_detail.item_id','=','items.id')
            ->select('users.name', 'items.image_url1', 'items.item_code','items.sale_type','orders_detail.*', 'orders.*')
            ->where('order_date','<=',$to_date)->get();

        }
        elseif($to_date == null){
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
            ->join('orders_detail','orders.id','=','orders_detail.order_id')
            ->join('items','orders_detail.item_id','=','items.id')
            ->select('users.name', 'items.image_url1', 'items.item_code','items.sale_type','orders_detail.*','orders.*')
            ->where('order_date','>=',$from_date)->get();

        }
        else{
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
            ->join('orders_detail','orders.id','=','orders_detail.order_id')
            ->join('items','orders_detail.item_id','=','items.id')
            ->select('users.name','items.image_url1', 'items.item_code','items.sale_type','orders_detail.*', 'orders.*')
            ->whereBetween('order_date',[$from_date,$to_date])->get();

        }
    }
    else{
        if($from_date == null && $to_date == null){
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('orders_detail','orders.id','=','orders_detail.order_id')
                    ->join('items','orders_detail.item_id','=','items.id')
    
                    ->select('users.name', 'items.image_url1', 'items.item_code','items.sale_type','orders_detail.*', 'orders.*')
                    ->where('preorder_status','=', $type)->get();

        }
        elseif($from_date == null){
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
            ->join('orders_detail','orders.id','=','orders_detail.order_id')
            ->join('items','orders_detail.item_id','=','items.id')
            ->select('users.name','items.image_url1', 'items.item_code','items.sale_type','orders_detail.*', 'orders.*')
            ->where('order_date','<=',$to_date)
            ->where('preorder_status','=', $type)->get();

        }
        elseif($to_date == null){
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
            ->join('orders_detail','orders.id','=','orders_detail.order_id')
            ->join('items','orders_detail.item_id','=','items.id')
            ->select('users.name','items.image_url1', 'items.item_code','items.sale_type','orders_detail.*', 'orders.*')
            ->where('order_date','>=',$from_date)
            ->where('preorder_status','=', $type)->get();

        }
        else{
            $orders    = DB::table("orders")->join('users', 'orders.user_id', '=', 'users.id')
            ->join('orders_detail','orders.id','=','orders_detail.order_id')
            ->join('items','orders_detail.item_id','=','items.id')
            ->select('users.name', 'items.image_url1', 'items.item_code','items.sale_type','orders_detail.*', 'orders.*')
            ->whereBetween('order_date',[$from_date,$to_date])
            ->where('preorder_status','=', $type)->get();

        }

    }
        $users     = DB::select('SELECT * from users where deleted_at is null');
        if($button == 1){
        return view('backend_v2.report.order_report')
        ->with('users',$users)
        ->with('from_date',$from_date)
        ->with('to_date',$to_date)
        ->with('type',$type)
        ->with('orders',$orders);
        }
        elseif($button == 2){

            $view = \View::make('backend_v2.report.order_pdf', ['orders'=>$orders]);
            $html_content = $view->render();
            PDF::SetTitle("List of order");
            PDF::AddPage();

          // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
          // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

            PDF::writeHTML($html_content, true, false, true, false, '');
            // D is the change of these two functions. Including D parameter will avoid
            // loading PDF in browser and allows downloading directly
              PDF::Output('orderist.pdf', 'D');


        }
        else{
            $data = [
                'orders' => $orders,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'type' => $type,
                'users' => $users,
                ];

            return Excel::download(new OrderSummaryView($data), 'export.xlsx');

        }


}
}