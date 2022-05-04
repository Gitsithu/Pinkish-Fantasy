<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\promocode;

use Illuminate\Support\Facades\Input;
class PromoCodeController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delete = DB::select('SELECT p.id from promo_code as p
        Where p.deleted_at IS NULL and curdate() > p.end_date');
        $d_count = count($delete);


      
        for($i=0;$i<$d_count;$i++){
        $f = $delete[$i]->id;

        $promotion = promocode::find($f);
        $promotion->forceDelete();

        }
        $promo_codes=DB::select('SELECT * from promo_code where deleted_at is null and status=1');
        $users = DB::select('SELECT * from users where deleted_at is null');
        return view('backend_v2.promo_code.index')
        ->with('promo_codes',$promo_codes)
        ->with('users',$users);
   
    }
    public function create()
    {
        return view('backend_v2.promo_code.create');

    }
    
    public function store(Request $request){
        $this->validate($request, [
            
            'start_date'        => 'required|after:today|before:end_date',
            'end_date'          => 'required|after:start_date',
            'user_limit'        => 'required|min:1',


        ]);

        try{
            $loginUser = Auth::user();
            $created_by = $loginUser->id;

            $data_count = promocode::count();
            $plus = rand (1 , 9);
            $last_id_count = $data_count + $plus;
            $id_length = strlen($last_id_count);
            $id_total_length = 6 - $id_length;
            $last_data_id = "";
            for ($i = 0; $i < $id_total_length; $i++) {
                $letter = chr(rand(65,90));
                $last_data_id .= $letter;
            }
            $last_data_id .= $last_id_count;

            $start_date               = $request->input('start_date');
            $end_date                 = $request->input('end_date');
            $user_limit               = $request->input('user_limit');
            $discount_id              = $request->input('discount_id');
            $discount                 = $request->input('discount');
            $created_at               = date("Y-m-d H:i:s");

            $max_user_obj = DB::SELECT("SELECT user_id,count(user_id) as u_count  FROM orders Group By user_id Having Count(user_id) = (SELECT MAX(mycount) FROM (SELECT user_id, COUNT(user_id) mycount FROM orders GROUP BY user_id) as sub)");
            if($max_user_obj == []){
                $smessage = 'Fail, There is no customer who have already ordered yet ...!';
                $request->session()->flash('fail', $smessage);
    
                return redirect()->action(
                    'backend\PromoCodeController@index'
                );
            }
            
            else{
            $max_user_count = $max_user_obj[0]->u_count;
            $user_array=[];
             // create the images file path to store the submission images
            for($i = $max_user_count;$i>0;$i--){
                $same_count_user_obj = DB::SELECT("SELECT user_id FROM orders GROUP BY orders.user_id Having count(user_id) = ".$i );
                $same_count_user_count = count($same_count_user_obj);
                for($j = 0;$j < $same_count_user_count;$j++){
                    $user_array[] = $same_count_user_obj[$j]->user_id;
                    $user_array_count = count($user_array);
                   

                }
                if($user_array_count >= $user_limit){
                        break;
                    }
            
            }
            $user = json_encode($user_array);
            if($discount_id == 1){
            DB::insert('insert into promo_code (code,start_date,end_date,user_limit,users_id,promo_percent,created_at,created_by) values(?,?,?,?,?,?,?,?)',
            [$last_data_id,$start_date,$end_date,$user_limit,$user,$discount,$created_at,$created_by]);
            }
            elseif($discount_id == 2){
            DB::insert('insert into promo_code (code,start_date,end_date,user_limit,users_id,promo_amount,created_at,created_by) values(?,?,?,?,?,?,?,?)',
            [$last_data_id,$start_date,$end_date,$user_limit,$user,$discount,$created_at,$created_by]);
            }
            
            // to alert message when it sucessfully created
            $smessage = 'Success, Promo Code created successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\PromoCodeController@index'
            );
        }
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in Promo Code creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\PromoCodeController@index'
            );
        }
    
    }
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        //to select id of faculty which is also equal to user's input id

         $promocodes = DB::table('promo_code')->where('id', $id)->first();
         return view('backend_v2.promo_code.edit', ['promocodes' => $promocodes]);
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
        //to validate form
        $this->validate($request, [

            'start_date'        => 'required|after:today|before:end_date',
            'end_date'          => 'required|after:start_date',
            'user_limit'        => 'required|min:1',

        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $start_date               = $request->input('start_date');
        $end_date                 = $request->input('end_date');
        $user_limit               = $request->input('user_limit');
        $updated_at         = date("Y-m-d H:i:s");

        $max_user_obj = DB::SELECT("SELECT user_id,count(user_id) as u_count  FROM orders Group By user_id Having Count(user_id) = (SELECT MAX(mycount) FROM (SELECT user_id, COUNT(user_id) mycount FROM orders GROUP BY user_id) as sub)");
        $max_user_count = $max_user_obj[0]->u_count;
        $user_array=[];
         // create the images file path to store the submission images
        for($i = $max_user_count;$i>0;$i--){
            $same_count_user_obj = DB::SELECT("SELECT user_id FROM orders GROUP BY orders.user_id Having count(user_id) = ".$i );
            $same_count_user_count = count($same_count_user_obj);
            for($j = 0;$j < $same_count_user_count;$j++){
                $user_array[] = $same_count_user_obj[$j]->user_id;
                $user_array_count = count($user_array);
               

            }
            if($user_array_count >= $user_limit){
                    break;
                }
        
        }
        $user = json_encode($user_array);
        try{
            

            // to create the folder path when it save images


                DB::update('update promo_code set  start_date = ?,  end_date = ?, user_limit = ?, users_id = ?, updated_at = ?, updated_by = ? where id = ?', [$start_date,$end_date,$user_limit,$user,$updated_at,$updated_by,$id]);
                
                $smessage = 'Success, Promo Code updated successfully ...!';
                $request->session()->flash('success', $smessage);

                // to return view
                return redirect()->action(
                    'backend\PromoCodeController@index'
                );
            }



            catch(Exception $e){

            // to show the alert box
            $smessage = 'Fail, Error in Promo Code updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\PromoCodeController@index'
            );
        }

 }

}