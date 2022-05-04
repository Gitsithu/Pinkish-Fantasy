<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\delivery;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class DeliveryController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $deliveries =  DB::select('SELECT * from delivery where deleted_at is null');


        return view('backend_v2.delivery.index')
            ->with('deliveries', $deliveries);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend_v2.delivery.create');
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
            'charges' => 'required',

        ]);
        $division            = $request->input('division');
        if($division==1){

            $this->validate($request, [
                'township' => 'required',

    
            ]);
        }
        $township            = $request->input('township');
        $charges             = $request->input('charges');
        $created_at          = date("Y-m-d H:i:s");

        try{

            DB::insert('insert into delivery (division,township,charges,created_at) values(?,?,?,?)',
            [$division,$township,$charges,$created_at,]);

                $message = 'Success, delivery set up successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\DeliveryController@index'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in delivery set up ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\DeliveryController@index'
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
        $deliveries = DB::table('delivery')->where('id', $id)->first();
        return view('backend_v2.delivery.edit', ['deliveries' => $deliveries]);

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
        //
        $this->validate($request, [
            'charges' => 'required',

        ]);
        
        $township            = $request->input('township');
        $charges             = $request->input('charges');
     
        $updated_at          = date("Y-m-d H:i:s");

        try{

            DB::update('update delivery set  township = ?, charges = ?, updated_at = ?  where id = ?', [$township,$charges,$updated_at,$id]);
            // if($status == 0){
            //     $sub_id = DB::select('SELECT id from sub_categories where main_categories_id ='.$id);
            //     $sub_count = $sub_id->count();
            //     for ($i=0; $i<$sub_count; $i++){
            //     $j=$sub_id[$i];
            //     DB::update('update sub_categories set  status = ?, updated_at = ?, updated_by = ? where main_categories_id = ?', [$status,$updated_at,$updated_by,$j]);

            //     }
                
            //     $cate_id = DB::select('SELECT c.id from categories as c join sub_categories as s on c.sub_categoreis_id=s.id where s.status =0');
            //     $cate_count=count($cate_id);
            //     for ($i=0; $i<$cate_count; $i++){
            //     $k=$cate_id[$i];
            //     DB::update('update categories set  status = ?, updated_at = ?, updated_by = ? where sub_categories_id = ?', [$status,$updated_at,$updated_by,$k]);
            //     }

            //     $item_id = DB::select('SELECT i.id from items as i join categories as c on i.categoreis_id=c.id where c.status =0');
            //     $item_count=count($item_id);
            //     for ($i=0; $i<$item_count; $i++){
            //     $l=$item_id[$i];
            //     DB::update('update items set  status = ?, updated_at = ?, updated_by = ? where categories_id = ?', [$status,$updated_at,$updated_by,$l]);
            //     }

            //     $item_spec_id = DB::select('SELECT s.id from items_specification as s join items as i on s.items_id=i.id where i.status =0');
            //     $item_sepc_count=count($item_spec_id);
            //     for ($i=0; $i<$item_spec_count; $i++){
            //     $m=$item_spec_id[$i];
            //     DB::update('update items_specification set  status = ?, updated_at = ?, updated_by = ? where items_id = ?', [$status,$updated_at,$updated_by,$m]);
            //     }

            
            $message = 'Success, delivery set up updating successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\DeliveryController@index'
                );

        }
        catch(Exception $e){

            $smessage = 'Fail, Error in delivery updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\DeliveryController@index'
            );

    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
}