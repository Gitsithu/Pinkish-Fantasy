<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\country;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status=1;
        $countries=DB::select('SELECT * from countries where deleted_at is null and status='.$status);
        $users = DB::select('SELECT * from users where deleted_at is null');


        return view('backend_v2.country.index')
            ->with('countries', $countries)
            ->with('users',$users);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend_v2.country.create');
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
            'name' => 'required',
            'status' => 'required',

        ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        $name                = $request->input('name');
        $exchange_rate       = $request->input('exchange_rate');
        $status              = $request->input('status');
        $created_at          = date("Y-m-d H:i:s");

        try{

        DB::insert('insert into countries (name,exchange_rate,status,created_at,created_by) values(?,?,?,?,?)',
        [$name,$exchange_rate,$status,$created_at,$created_by]);


                $message = 'Success, country created successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\CountryController@index'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in country creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\CountryController@index'
            );
        }
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
        $countries = DB::table('countries')->where('id', $id)->first();
        return view('backend_v2.country.edit', ['countries' => $countries]);

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
            'name' => 'required|unique:countries,name,'. $id .'',
            'status' => 'required',

        ]);

        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $name                       = $request->input('name');
        $exchange_rate              = $request->input('exchange_rate');
        $status                     = $request->input('status');
        $updated_at                 = date("Y-m-d H:i:s");
        // $changes = DB::select('SELECT * from items where deleted_at is null and countries_id ='.$id);
    
        // $count = count($changes)-1;
        // for($i = 0; $i <= $count; $i++){
        //     $item_id = $changes[$i]->id;
        //     $price = $changes[$i]->purchase_price;
        //     $cargo= $changes[$i]->cargo_fee;
        //     $additional_charges=$changes[$i]->additional_charges;
          
            
        //     $purchase = $price*$exchange_rate;
        //     if($purchase <= 70000){
        //         $profit_id = 1;
        //         $profit = DB::table("profit")->where('id','=',1)->value('percent');
        //     }
        //     elseif($purchase > 70000 && $purchase <= 140000){
        //         $profit_id = 2;
        //         $profit = DB::table("profit")->where('id','=',2)->value('percent');
        //     }
        //     elseif($purchase > 140000 && $purchase <= 210000){
        //         $profit_id = 3;
        //         $profit = DB::table("profit")->where('id','=',3)->value('percent');
        //     }
        //     elseif($purchase > 210000){
        //         $profit_id = 4;
        //         $profit = DB::table("profit")->where('id','=',4)->value('percent');
        //     }

        //     $profit_percent = $profit/100;
        //     $purchase_percent = $purchase * $profit_percent;

        //     $purchase_price = $purchase + $purchase_percent;

        
        // $sale_price = (int)round($purchase_price + $additional_charges + $cargo);

        // $sub=substr($sale_price,-2,2);
        // if($sub == 00){
        //     $sale_price;
        // }
        // elseif($sub < 50){
        //    $sale_price = substr_replace($sale_price,50,-2,2);
        // }
        // else{
        //     $sale_price += 100;
        //     $minus = substr($sale_price,-2,2);
        //     $sale_price -= $minus;
        // }

        // DB::update('update items set  profit_id = ?, sale_price = ?, updated_at = ?, updated_by = ? where id = ?', [$profit_id,$sale_price,$updated_at,$updated_by,$item_id]);

        
        // }
        try{

            DB::update('update countries set  name = ?, exchange_rate = ?, status = ?, updated_at = ?, updated_by = ? where id = ?', [$name,$exchange_rate,$status,$updated_at,$updated_by,$id]);

            $message = 'Success, country updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\CountryController@index'
                );

        }
        catch(Exception $e){

            $smessage = 'Fail, Error in country updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\CountryController@index'
            );

    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $countries = country::find($id);

        // Very Dangerous - Fully Delete Action
        // If no need to destory permanently, u should not use it
        // System will crash in other parts
        // brand::destroy($id);

        // $status = 0;
        // $updated_at = date("Y-m-d H:i:s");
        // DB::update('update brand set status = ?, updated_at = ? where id = ?', [$status, $updated_at, $id]);

        // https://laravel.com/docs/5.8/eloquent#soft-deleting

        // $notes = brand::withTrashed()->get();
        // $obj = brand::withTrashed()
        //         ->where('id', $id)
        //         ->get();
        // $post = App\Post::withTrashed()->whereId(2)->restore();

        $countries->delete();
        if ($countries->trashed()) {
            $message = 'Success, ' . $countries->name .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\CountryController@index'
            );
        }
        else{

            $message = 'Fail, ' . $countries->name .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\CountryController@index'
            );
        }
    }
    public function inactive()
    {
        //

        $countries=DB::select('SELECT * from countries where deleted_at is null and status=0');
        $users = DB::select('SELECT * from users where deleted_at is null');



        return view('backend_v2.country.inactive')
            ->with('countries', $countries)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //

        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least a country!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\CountryController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("countries")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, country activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\CountryController@inactive');
        }
    }

    }
