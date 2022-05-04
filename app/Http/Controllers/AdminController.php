<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;


class AdminController extends Controller
{
    public function index(){


        if (Auth::check()) {


                $date=date("d-m-y");
            // Start - Searching Count Process
                $to_preorder_count_raw = DB::select('select count(id) AS to_preorder_count from orders where preorder_status = 1');

                if (isset($to_preorder_count_raw) && count($to_preorder_count_raw)>0) {
                    $to_preorder_count = $to_preorder_count_raw[0]->to_preorder_count;
                } else {
                    $to_preorder_count = 0;
                }

                $preordered_count_raw = DB::select('select count(id) AS preordered_count from orders where preorder_status = 2');

                if (isset($preordered_count_raw) && count($preordered_count_raw)>0) {
                    $preordered_count = $preordered_count_raw[0]->preordered_count;
                } else {
                    $preordered_count = 0;
                }

                $received_count_raw = DB::select('select count(id) AS received_count from orders where preorder_status = 3');

                if (isset($received_count_raw) && count($received_count_raw)>0) {
                    $received_count = $received_count_raw[0]->received_count;
                } else {
                    $received_count = 0;
                }

                $delivered_count_raw = DB::select('select count(id) AS delivered_count from orders where preorder_status = 4');

                if (isset($delivered_count_raw) && count($delivered_count_raw)>0) {
                    $delivered_count = $delivered_count_raw[0]->delivered_count;
                } else {
                    $delivered_count = 0;
                }

                $pending_count_raw = DB::select('select count(id) AS pending_count from orders where status = 1');

                if (isset($pending_count_raw) && count($pending_count_raw)>0) {
                    $pending_count = $pending_count_raw[0]->pending_count;
                } else {
                    $pending_count = 0;
                }

                // $no_payment_count_raw = DB::select('select count(id) AS no_payment_count from orders where payment_status = 0');

                // if (isset($no_payment_count_raw) && count($no_payment_count_raw)>0) {
                //     $no_payment_count = $no_payment_count_raw[0]->no_payment_count;
                // } else {
                //     $no_payment_count = 0;
                // }

                // $half_payment_count_raw = DB::select('select count(id) AS half_payment_count from orders where payment_status = 1');

                // if (isset($half_payment_count_raw) && count($half_payment_count_raw)>0) {
                //     $half_payment_count = $half_payment_count_raw[0]->half_payment_count;
                // } else {
                //     $half_payment_count = 0;
                // }

                // $complete_payment_count_raw = DB::select('select count(id) AS complete_payment_count from orders where payment_status = 1');

                // if (isset($complete_payment_count_raw) && count($complete_payment_count_raw)>0) {
                //     $complete_payment_count = $complete_payment_count_raw[0]->complete_payment_count;
                // } else {
                //     $complete_payment_count = 0;
                // }

                $users_count_raw = DB::select('select count(id) AS users_count from users where role_id = 4');

                if (isset($users_count_raw) && count($users_count_raw)>0) {
                    $users_count = $users_count_raw[0]->users_count;
                } else {
                    $users_count = 0;
                }
                $orders_count_raw=array();
                $orders_months = DB::select('select order_date from orders');
                $orders_months_count = count($orders_months);
                for($i = 0;$i<$orders_months_count;$i++){
                    // $d=strtotime($orders_months[$i]->order_date);
                    // $order_month = date("m",$d);
                    $today = date('Y');
                    $orders_count_raw[$i] = DB::select("select distinct month(order_date),MONTHNAME(order_date) as month,count(month(order_date)) AS orders_count from orders where YEAR(CURRENT_TIMESTAMP) = YEAR(order_date) GROUP BY  MONTHNAME(order_date),month(order_date) ORDER BY month(order_date) ASC");

                }
                if($orders_count_raw==[]){

                    return view('backend_v2.dashboard')
                    ->with('to_preorder_count', $to_preorder_count)
                    ->with('preordered_count', $preordered_count)
                    ->with('delivered_count', $delivered_count)
                    ->with('received_count', $received_count)
                    ->with('pending_count', $pending_count)
                    // ->with('no_payment_count', $no_payment_count)
                    // ->with('half_payment_count', $half_payment_count)
                    // ->with('complete_payment_count', $complete_payment_count)
                    ->with('date', $date)
                    ->with('users_count', $users_count);


                }
                else{

                $orders = $orders_count_raw[0];
                return view('backend_v2.dashboard')
                ->with('to_preorder_count', $to_preorder_count)
                ->with('preordered_count', $preordered_count)
                ->with('delivered_count', $delivered_count)
                ->with('received_count', $received_count)
                ->with('pending_count', $pending_count)
                // ->with('no_payment_count', $no_payment_count)
                // ->with('half_payment_count', $half_payment_count)
                // ->with('complete_payment_count', $complete_payment_count)
                ->with('orders', $orders)
                ->with('date', $date)
                ->with('users_count', $users_count);



                }


            }
            else{
                return redirect()->route('login');
            }


    }

    //chart code
    // <?php

    // if(isset($orders)){
    //     foreach($orders as $orders_count)

    // {
    // $dataPoints [] =array("y"=>$orders_count->orders_count, "label" => $orders_count->month);

    // }


    // }
    // else{
    //     $dataPoints [] =array("label"=>" ");

    // }

    //
    public function settings(){
        $menu_active=0;
        return view('backEnd.setting',compact('menu_active'));
    }
    public function chkPassword(Request $request){
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_pwd=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_pwd->password)){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
    public function updatAdminPwd(Request $request){
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_password=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_password->password)){
            $password=bcrypt($data['pwd_new']);
            User::where('email',$email_login)->update(['password'=>$password]);
            return redirect('/admin/settings')->with('message','Password Update Successfully');
        }else{
            return redirect('/admin/settings')->with('message','InCorrect Current Password');
        }
    }





    /*public function login(Request $request){
        if($request->isMethod('post')){
            $data=$request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                echo 'success'; die();
            }else{
                return redirect('admin')->with('message','Account is Incorrect!');
            }
        }else{
            return view('backEnd.login');
        }
    }*/
}
