<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Core\promotion;
use App\promotion_detail;
use App\promotions;
use Illuminate\Support\Facades\Input;
use App\Core\ReturnMessage as ReturnMessage;

class PromotionController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $pre_status = DB::select('SELECT id from promotion where curdate() > end_date ');
            $p_count = count($pre_status);
            for($j=0; $j<$p_count; $j++){
                $id=$pre_status[$j]->id;
                $status = 0;
                DB::update('update promotion set  status = ? where id = ? ', [$status,$id]);
                DB::update('update promotion_detail set  status = ? where p_id = ? ', [$status,$id]);


            }

            $delete = DB::select('SELECT p.id from promotion as p
            Where p.deleted_at IS NULL and curdate() > DATE_ADD(p.end_date, interval 7 day)');
            $d_count = count($delete);



            for($i=0;$i<$d_count;$i++){
            $f = $delete[$i]->id;

            $promotion = promotions::find($f);
            $promotion_detail = promotion_detail::where('p_id',$f)->forceDelete();
            $promotion->forceDelete();

            

            }

            $promotions=DB::select('SELECT * from promotion where deleted_at is null');
            $users = DB::select('SELECT * from users where deleted_at is null');
            $category = DB::select('SELECT * from categories where deleted_at is null');
            $item = DB::select('SELECT * from items where deleted_at is null');
            $brand = DB::select('SELECT * from brands where deleted_at is null');
        return view('backend_v2.promotion.index')
        ->with('promotions',$promotions)
        ->with('users',$users)
        ->with('category',$category)
        ->with('item',$item)
        ->with('brand',$brand);

    }
    public function create()
    {
        return view('backend_v2.promotion.create');

    }

    public function store(Request $request){
        $this->validate($request, [

            'start_date'        => 'required|after:today',
            'end_date'          => 'required|after:today',
            'product_status'    => 'required',



        ]);

        try{
            $loginUser = Auth::user();
            $created_by = $loginUser->id;

            $name                     = $request->input('name');
            $start_date               = $request->input('start_date');
            $end_date                 = $request->input('end_date');
            $product_status           = $request->input('product_status');
            $product_id               = $request->input('product_id');
            $discount_id              = $request->input('discount_id');
            $discount                 = $request->input('discount');
            $created_at               = date("Y-m-d H:i:s");

           
              
             // create the images file path to store the submission images
            if($product_status == 1){

                $ps = 1;

                if($discount_id == 1){
                    DB::insert('insert into promotion (name,start_date,end_date,product_status,promo_percent,created_at,created_by) values(?,?,?,?,?,?,?)',
                    [$name,$start_date,$end_date,$ps,$discount,$created_at,$created_by]);
    
                    }
                    elseif($discount_id == 2){
                    DB::insert('insert into promotion (name,start_date,end_date,product_status,promo_amount,created_at,created_by) values(?,?,?,?,?,?,?)',
                    [$name,$start_date,$end_date,$ps,$discount,$created_at,$created_by]);
                    }
                    // elseif($discount_id == 3){
                    //     DB::insert('insert into promotion (name,start_date,end_date,product_status,promo_discount_amt,created_at,created_by) values(?,?,?,?,?,?,?)',
                    //     [$name,$start_date,$end_date,$ps,$discount,$created_at,$created_by]);
                    //     }
        
    
                    $promotion_id                   = DB::table('promotion')->max('id');

                $categories=DB::select('SELECT * from categories where status = 1 and deleted_at is null');
                $categories_count = count($categories);
                for($i = 0 ;$i < $categories_count;$i++){

                $pi = $categories[$i]->id;

                DB::insert('insert into promotion_detail (p_id,product_id,created_at,created_by) values(?,?,?,?)',
                [$promotion_id,$pi,$created_at,$created_by]);


               
            }
        }
            else{
                if($discount_id == 1){
                    DB::insert('insert into promotion (name,start_date,end_date,product_status,promo_percent,created_at,created_by) values(?,?,?,?,?,?,?)',
                    [$name,$start_date,$end_date,$product_status,$discount,$created_at,$created_by]);
    
                    }
                    elseif($discount_id == 2){
                    DB::insert('insert into promotion (name,start_date,end_date,product_status,promo_amount,created_at,created_by) values(?,?,?,?,?,?,?)',
                    [$name,$start_date,$end_date,$product_status,$discount,$created_at,$created_by]);
                    }
                    // elseif($discount_id == 3){
                    //     DB::insert('insert into promotion (name,start_date,end_date,product_status,promo_discount_amt,created_at,created_by) values(?,?,?,?,?,?,?)',
                    //     [$name,$start_date,$end_date,$product_status,$discount,$created_at,$created_by]);
                    //     }
        
                $promotion_id                   = DB::table('promotion')->max('id');
                $product_count = count($product_id);
                for($i = 0 ;$i < $product_count;$i++){
                $pi = $product_id[$i];

                    DB::insert('insert into promotion_detail (p_id,product_id,created_at,created_by) values(?,?,?,?)',
                    [$promotion_id,$pi,$created_at,$created_by]);


               

                }


            }


            // to alert message when it sucessfully created
            $smessage = 'Success, Promotion created successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\PromotionController@index'
            );
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in Promotion creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\PromotionController@index'
            );
        }
    }

    public function getProductsByStatus($productstatus){

        $raw_data      = promotion::getProductsByConditions($productstatus);
        // $output = "";
        // foreach($raw_data as $data) {
        //     $output .= '<option value="'.$data->id.'">'.$data->name.'</option>';
        // }
        // $data = array();
        // $data['output']=$output;
        return response()->json($raw_data, ReturnMessage::OK);

        // try{
        //     $inputs = Input::all();
        //     $request_conditions = isset($inputs['conditions']) ? $inputs['conditions'] : null;
        //     $raw_conditions = json_decode($request_conditions);

        //     $conditions = array();
        //     foreach ($raw_conditions as $key => $value) {
        //         $conditions[$key] = $value;
        //     }

        //     // getting data by array format
        //     $raw_data      = promotion::getProductsByConditions($conditions, $temp_table_name);

        //     $result_array = array();
        //     $result_array['result_array'] = $raw_data;

        //     $raw_objs = $raw_data;
        //     $item_list = "";

        //     foreach ($raw_objs as $item) {

        //         $item_list .= '<option value="'. $item->id .'">'. $item->name .'</option>';

        //     }

        //     $returned_obj['objs'] = $item_list;

        //     $returned_obj['status_code'] = ReturnMessage::OK;
        //     $returned_obj['status_message'] = "Syncs down process completed successfully !";
        //     $returned_obj['data'] = $result_array;

        //     return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::OK);
        // }
        // catch (\Exception $e) {
        //     $returned_obj['status_code'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        //     $returned_obj['status_message'] = $e->getMessage();
        //     $returned_obj['data'] = array();
        //     $returned_obj['objs'] = "";

        //     return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::INTERNAL_SERVER_ERROR);
        // }
    }
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        //to select id of faculty which is also equal to user's input id

         $promotions = DB::table('promotion')->where('id', $id)->first();
         return view('backend_v2.promotion.edit', ['promotions' => $promotions]);
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

            'start_date'        => 'required|after:today',
            'end_date'          => 'required|after:today',
            'name'              => 'required|unique:promotion,name,'. $id .'',

        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $start_date               = $request->input('start_date');
        $end_date                 = $request->input('end_date');
        $name                     = $request->input('name');
        $updated_at               = date("Y-m-d H:i:s");

        $old_name =  DB::table('promotion')->where('id', $id)->value('name');
        $old_sd   =  DB::table('promotion')->where('id', $id)->value('start_date');
        $old_ed   =  DB::table('promotion')->where('id', $id)->value('end_date');
        //and start_date = ".$old_sd." and end_date = ".$old_ed
        $change_data = DB::SELECT("SELECT id FROM promotion where name = '$old_name' and start_date = '$old_sd' and end_date = '$old_ed'");

        try{

            $data_count = count($change_data);
            for($i = 0;$i<$data_count;$i++){
            $data = $change_data[$i]->id;
            DB::update('update promotion set  start_date = ?,  end_date = ?, name = ?, updated_at = ?, updated_by = ? where id = ?', [$start_date,$end_date,$name,$updated_at,$updated_by,$data]);

            }
            // to create the folder path when it save images



                $smessage = 'Success, Promotion updated successfully ...!';
                $request->session()->flash('success', $smessage);

                // to return view
                return redirect()->action(
                    'backend\PromotionController@index'
                );
            }



            catch(Exception $e){

            // to show the alert box
            $smessage = 'Fail, Error in Promotion updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\PromotionController@index'
            );
        }

 }
 public function change(Request $request)
 {
     //
    $ids = Input::get('selected_checkboxes');
    if($ids == null){
     $message = 'You need to select at least a promotion!';
     $request->session()->flash('fail', $message);

     return redirect()->action(
         'backend\PromotionController@index'
     );

    }
    else{
    $new_string = explode(',', $ids);
    foreach ($new_string as $ids) {


        $promotion = promotions::find($ids);
        $promotion_detail = promotion_detail::where('p_id',$ids)->forceDelete();
        $promotion->forceDelete();


    }


     $message = 'Success,Promotions deleted successfully ...!';
     $request->session()->flash('success', $message);
     return redirect()->action(
         'backend\PromotionController@index');
     }
 }
 public function detail($id)
 {

    $id = Crypt::decrypt($id);

    $promotions = DB::select('SELECT pd.id as id,pd.status as pstatus,p.name as pname,p.product_status as product_status,pd.product_id as product_id
                        from promotion as p
                        join promotion_detail as pd
                        on pd.p_id = p.id
                        where pd.p_id='.$id);
     $category = DB::select('SELECT * from categories where deleted_at is null');
     $item = DB::select('SELECT * from items where deleted_at is null');
     $brand = DB::select('SELECT * from brands where deleted_at is null');
 return view('backend_v2.promotion.promotion_detail')
 ->with('promotions',$promotions)
 ->with('category',$category)
 ->with('item',$item)
 ->with('brand',$brand);;
 }
 public function change2(Request $request)
 {
     //
    $ids = Input::get('selected_checkboxes');
    if($ids == null){
     $message = 'You need to select at least a promotion detail!';
     $request->session()->flash('fail', $message);

     return redirect()->action(
         'backend\PromotionController@index'
     );

    }
    else{
    $new_string = explode(',', $ids);
    foreach ($new_string as $ids) {


        $promotion = promotion_detail::find($ids);
        $promotion->forceDelete();


    }


     $message = 'Success,Promotion Details deleted successfully ...!';
     $request->session()->flash('success', $message);
     return redirect()->action(
         'backend\PromotionController@index');
     }
 }
}