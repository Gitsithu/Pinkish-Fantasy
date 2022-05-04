<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\Core\promotion;
use App\deli_promo;
use Illuminate\Support\Facades\Input;
use App\Core\ReturnMessage as ReturnMessage;

class DeliPromoController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $pre_status = DB::select('SELECT id from deli_promo where curdate() > end_date ');
            $p_count = count($pre_status);
            for($j=0; $j<$p_count; $j++){
                $id=$pre_status[$j]->id;
                $status = 0;
                DB::update('update deli_promo set  status = ? where id = ? ', [$status,$id]);


            }

            $delete = DB::select('SELECT d.id from deli_promo as d
            Where d.deleted_at IS NULL and curdate() > DATE_ADD(d.end_date, interval 7 day)');
            $d_count = count($delete);



            for($i=0;$i<$d_count;$i++){
            $f = $delete[$i]->id;

            $promotion = deli_promo::find($f);
            $promotion->forceDelete();

            

            }

            $promotions=DB::select('SELECT * from deli_promo where deleted_at is null');
            $users = DB::select('SELECT * from users where deleted_at is null');
            $category = DB::select('SELECT * from categories where deleted_at is null');
            $item = DB::select('SELECT * from items where deleted_at is null');
            $brand = DB::select('SELECT * from brands where deleted_at is null');
        
        return view('backend_v2.deli_promo.index')
        ->with('promotions',$promotions)
        ->with('users',$users)
        ->with('category',$category)
        ->with('item',$item)
        ->with('brand',$brand);

    }
    public function create()
    {
        return view('backend_v2.deli_promo.create');

    }

    public function store(Request $request){
        $this->validate($request, [

            'start_date'        => 'required|after:today',
            'end_date'          => 'required|after:today',
            'amt'               => 'required',



        ]);

        try{
            $loginUser = Auth::user();
            $created_by = $loginUser->id;

            $start_date               = $request->input('start_date');
            $end_date                 = $request->input('end_date');
            $amt                      = $request->input('amt');
            $created_at               = date("Y-m-d H:i:s");

           
            DB::insert('insert into deli_promo (start_date,end_date,amt,created_at,created_by) values(?,?,?,?,?)',
                       [$start_date,$end_date,$amt,$created_at,$created_by]);
    


            // to alert message when it sucessfully created
            $smessage = 'Success, Delivery Promotion created successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\DeliPromoController@index'
            );
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in Delivery Promotion creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\DeliPromoController@index'
            );
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        //to select id of faculty which is also equal to user's input id

         $promotions = DB::table('deli_promo')->where('id', $id)->first();
         return view('backend_v2.deli_promo.edit', ['promotions' => $promotions]);
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
            'amt'               => 'required',

        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $start_date               = $request->input('start_date');
        $end_date                 = $request->input('end_date');
        $amt                      = $request->input('amt');
        $updated_at               = date("Y-m-d H:i:s");
        try{

            DB::update('update deli_promo set  start_date = ?,  end_date = ?, amt = ?, updated_at = ?, updated_by = ? where id = ?', [$start_date,$end_date,$amt,$updated_at,$updated_by,$id]);

           

                $smessage = 'Success, Delivery Promotion updated successfully ...!';
                $request->session()->flash('success', $smessage);

                // to return view
                return redirect()->action(
                    'backend\DeliPromoController@index'
                );
            }
            catch(Exception $e){

            // to show the alert box
            $smessage = 'Fail, Error in Delivery Promotion updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\DeliPromoController@index'
            );
        }

 }
}