<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\User;
use App\Order;
use App\Order_detail;
use App\Item_specification;
use App\deli_promo;
use App\Core\Utility as Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class CheckOutController extends Controller
{
    public function viewcart(){
        $check_deli_promo = Deli_promo::where('status',1)
                                ->where('start_date','<=',Carbon::today()->toDateString())
                                ->where('end_date','>=',Carbon::today()->toDateString())
                                ->count();
        if ($check_deli_promo > 0) {
            $deli_promo = Deli_promo::where('status',1)
                            ->where('start_date','<=',Carbon::today()->toDateString())
                            ->where('end_date','>=',Carbon::today()->toDateString())
                            ->value('amt');
        } else {
            $deli_promo = "";
        }
        return view('frontEnd.cart',compact('deli_promo'));
    }

    public function index(){
        $user_data = User::find(Auth::user()->id);
        $deliveries = DB::table('delivery')->where('status',1)->groupBy('division')->orderBy('division','desc')->get();
        $deli_promo = DB::table('deli_promo')
                        ->where('status',1)
                        ->where('start_date','<=',Carbon::today()->toDateString())
                        ->where('end_date','>=',Carbon::today()->toDateString())
                        ->select('amt')
                        ->first();
        $users = "";
        $promo = DB::table('promo_code')
                ->where('promo_code.start_date','<=',Carbon::today()->toDateString())
                ->where('promo_code.end_date','>=',Carbon::today()->toDateString())
                ->where(function($query) use ($users) {
                    $users = json_decode('promo_code.users_id');
                    if(is_array($users) || is_object($users)) {
                        foreach($users as $user) {
                            $query->where('$user',Auth::user()->id);
                        }
                    }
                })
                ->where('status',1)
                ->first();
        $banks = DB::table('banks_info')->where('status',1)->get();
        return view('frontEnd.checkout.index',compact('user_data','deliveries','deli_promo','promo','banks'));
    }

    public function submitCheckout(Request $request){
        if ($request->division == 1) {
            $this->validate($request,[
                'township'=>'required',
            ]);
        }
        $this->validate($request,[
            'name'=>'required|string',
            'address'=>'required',
            'division'=>'required',
            'phone'=>'required',
            'bank'=>'required',
            'payment_ss'=>'required',
        ]);

        // Start generating customized order id
        $date = Carbon::now();
        $data_count = Order::count();
        $last_id_count = $data_count + 1;
        $id_length = strlen($last_id_count);
        $id_total_length = 6 - $id_length;
        $last_date_id = str_replace("-", "", $date->toDateString());
        for ($i = 0; $i < $id_total_length; $i++) {
            $last_date_id .= '0';
        }
        $last_date_id .= $last_id_count;
        // End generating customized order id

        $input_data = $request->all();

        $order = new Order;
        $order->id = $last_date_id;
        $order->order_date = $date->toDateString();

        $order->user_id = Auth::user()->id;
        $order->customer_name = $input_data['name'];
        $order->delivery_address = $input_data['address'];
        $order->delivery_id = (int)$input_data['delivery_id'];
        $order->phone = $input_data['phone'];
        $order->email = $input_data['email'];

        $order->total_quantity = 0;
        $order->cart_total = 0;
        $order->delivery_cost = (int)$input_data['delivery_cost'];

        // Get Promo Code ID accroding to Promo Code
        $order->promo_code_id = DB::table('promo_code')->where('code',$input_data['promo_code'])->value('id');
        // Get Promo Code ID accroding to Promo Code

        $order->payment_type = "Pre-paid";
        $order->bank_id = (int)$input_data['bank'];

        $path = base_path() . '/public/customerSite/img/customer_payment_ss/';
        $input_payment_ss = Input::file('payment_ss');
        $payment_ss_original_name = Utility::getImage($input_payment_ss);
        $payment_ss_extension = Utility::getImageExt($input_payment_ss);
        $payment_ss = uniqid() . "." . $payment_ss_extension;
        $payment_ss_image = Utility::resizeImage($input_payment_ss, $payment_ss, $path);
        $order->payment_screenshot = '/customerSite/img/customer_payment_ss/' . $payment_ss;

        $checkout_carts = json_decode($request->cart_item);
        foreach ($checkout_carts->itemlist as $i => $v) {
            if($v->ordertype == 1) {
                $order->preorder_status = 1;
            } else {
                $order->preorder_status = 0;
            }

            $od = new Order_detail;
            $od->order_id = $order->id;
            $od->item_id = (int)$v->id;
            $od->specification_id = (int)$v->spec_id;
            $od->price = $v->price;
            $od->promotion_id = (int)$v->promotion;
            $od->quantity = $v->qty;
            $od->sub_total = $v->subtotal;

            $order->total_quantity += $od->quantity;
            $order->cart_total += $od->sub_total;

            if($order->preorder_status != 1) {
                $org_instock = DB::table('items_specification')->where('id',$od->specification_id)->value('qty');
                $new_instock = $org_instock - $od->quantity;
                $update_instock = DB::table('items_specification')->where('id',$od->specification_id)->update([
                    'qty'=>$new_instock
                ]);
                $count_update_item_qty = DB::table('items_specification')->where('items_id',$od->item_id)->sum('qty');
                if($count_update_item_qty == 0) {
                    $archive_item = DB::table('items')->where('id',$od->item_id)->update(['status'=>0]);
                }
            }
            $od->save();
        }
        $order->final_cost = (int)$input_data['final_cost'];
        $order->save();
        return redirect('/')->with('checkout_success','Checkout Successfully! We will process your Order in a few days.');
    }

    public function reviewOrder() {
        $review_orders = Order::where([['user_id', Auth::user()->id],['status','!=',2]])->get();
        $delete_canceled = DB::select('SELECT o.id from orders as o
            Where o.deleted_at IS NOT NULL and o.status = 2 and curdate() > DATE_ADD(o.deleted_at, interval 7 day)');
        $d_count = count($delete_canceled);
        for($i = 0; $i < $d_count; $i++) {
            $id = $delete_canceled[$i]->id;
            $delete_canceled_orders = Order::where('id',$id)->forceDelete();
        }
        $delete_completed = DB::select('SELECT o.id from orders as o
            Where o.status = 4 and curdate() > DATE_ADD(o.updated_at, interval 365 day)');
        $d_count = count($delete_completed);
        for($i = 0; $i < $d_count; $i++) {
            $id = $delete_completed[$i]->id;
            $delete_completed_orders = Order::where('id',$id)->forceDelete();
        }
        return view('frontEnd.checkout.review_order', compact('review_orders'));
    }

    public function reviewOrderDetail($id) {
        $id = Crypt::decrypt($id);
        $order = Order::findorFail($id);
        $order_details = Order_detail::where('order_id',$order->id)->get();
        return view('frontEnd.checkout.review_order_detail', compact('order','order_details'));
    }

    public function editPaymentSS(Request $request, $id) {
        $id = Crypt::decrypt($id);

        // Remove Existing Payment Screenshot
        $current_payment_ss = Order::where('id',$id)->value('payment_screenshot');
        $current_image_file = $current_payment_ss;
        $current_path=public_path();
        unlink($current_path.$current_image_file);
        Utility::removeImage($current_image_file);
        // Remove Existing Payment Screenshot

        // Add New Payment Screenshot
        $new_path = base_path() . '/public/customerSite/img/customer_payment_ss/';
        $new_image_url = Input::file('payment_screenshot');
        $new_image_url_name_original = Utility::getImage($new_image_url);
        $new_image_url_ext = Utility::getImageExt($new_image_url);
        $new_image_url_name = uniqid() . "." . $new_image_url_ext;
        $new_image = Utility::resizeImage($new_image_url, $new_image_url_name, $new_path);
        $new_image_file = '/customerSite/img/customer_payment_ss/' . $new_image_url_name;

        DB::table("orders")->where('id',$id)->update(['payment_screenshot' => $new_image_file]);
        return redirect()->back()->with('success','Your Payment Screenshot is updated Successfully!');
    }

    public function cancelOrder($id) {
        $delete_order_check = Order::where('id',$id)->first();

        $image_file = $delete_order_check->payment_screenshot;
        $path=public_path();
        unlink($path.$image_file);
        Utility::removeImage($image_file);
        $deleted_at = date('Y-m-d H:i:s');

        if ($delete_order_check->preorder_status != 1) {
            $delete_order_details_checks = Order_detail::where('order_id',$id)->get();
            foreach($delete_order_details_checks as $delete_order_details_check) {
                $sale_type_check = DB::table('items')->where('id',$delete_order_details_check->item_id)->value('sale_type');
                if($sale_type_check == 0) {
                    $current_qty = Item_specification::where([['id',$delete_order_details_check->specification_id],['items_id',$delete_order_details_check->item_id]])->value('qty');
                    $refund_qty = $delete_order_details_check->quantity + $current_qty;
                    $refund = Item_specification::where([['id',$delete_order_details_check->specification_id],['items_id',$delete_order_details_check->item_id]])->update(['qty'=>$refund_qty]);
                }
            }
            //Just change the status 6/4 HH
            DB::table("orders")->where('id',$id)->update(['status' => 2, 'deleted_at' => $deleted_at]);
            return redirect('/review-order')->with('alert','You have successfully canceled the Order!');
        } else {
            DB::table("orders")->where('id',$id)->update(['status' => 2, 'deleted_at' => $deleted_at]);
            return redirect('/review-order')->with('alert','You have successfully canceled the Order!');
        }
    }

    public function bank_acc_no(Request $request) {
        $attr = $request->all();
        $bank_acc = DB::table('banks_info')->where('id',$attr['bank'])->select('account_name','account_no')->first();
        echo $bank_acc->account_name.",".$bank_acc->account_no;
    }

    public function getTownships(Request $request) {
        $attr = $request->all();
        $townships = DB::table('delivery')->where([['division',$attr['division']],['status',1]])->orderBy('township','asc')->select('id','township')->get();
        echo $townships;
    }
    
    public function delivery(Request $request) {
        $attr = $request->all();
        if($attr['division'] != 1) {
            $delivery = DB::table('delivery')->where('division',$attr['division'])->select('id','charges')->first();
        } else {
            $delivery = DB::table('delivery')->where('id',$attr['delivery_id'])->select('id','charges')->first();
        }
        echo $delivery->id.",".$delivery->charges;
    }
}
