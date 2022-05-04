<?php
namespace App\Http\Controllers\backend;
use Auth;
use DB;
use App\profit;
use Illuminate\Http\Request;
use App\Core\Utility as Utility;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ProfitController extends Controller
{
    //
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // to select data from profit table where deleted-at is null and status = active
    $profits=DB::select('SELECT * from profit where deleted_at is null');
       return view('backend_v2.profit.index')
        ->with('profits',$profits);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=DB::select('SELECT * from countries where status = 1 and deleted_at is null');

        return view('backend_v2.profit.create')
        ->with('countries',$countries);
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // to validate form

        $this->validate($request, [
            'min'    => 'required',
            'max'    => 'required',
            'percent' => 'required',



        ]);

        try{
            $min                = $request->input('min');
            $max                = $request->input('max');
            $country            = $request->input('countries_id');
            $percentage         = $request->input('percent');
            $created_at         = date("Y-m-d H:i:s");

            DB::insert('insert into profit (min,max,percent,countries_id,created_at) values(?,?,?,?,?)',
                        [$min,$max,$percentage,$country,$created_at]);

            // to alert message when it sucessfully created
            $smessage = 'Success, profit set successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\ProfitController@index'
            );
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in profit setting ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ProfitController@index'
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
    //     $this->validate($request, [
    //         'percentage' => 'required',

    //     ]);
    //     $loginUser = Auth::user();
    //     $updated_by = $loginUser->id;
    //     $percentage                 = $request->input('percentage');
    //     $change                     = $request->input('change');
    //     $updated_at                 = date("Y-m-d H:i:s");

    //     if($change == 1){
    //     $changes = DB::select('SELECT * from items where deleted_at is null and profit_id ='.$id);

    //     $count = count($changes)-1;
    //     for($i = 0; $i <= $count; $i++){
    //         $item_id = $changes[$i]->id;
    //         $price = $changes[$i]->purchase_price;
    //         $cargo= $changes[$i]->cargo_fee;
    //         $exchange_rate_id=$changes[$i]->countries_id;
    //         $additional_charges=$changes[$i]->additional_charges;
    //         $exchange_rate=DB::table("countries")->where('id','=',$exchange_rate_id)->value('exchange_rate');
    //         $profit = $percentage;
    //         $purchase = $price*$exchange_rate;

    //         $profit_percent = $profit/100;
    //         $purchase_percent = $purchase * $profit_percent;

    //         $purchase_price = $purchase + $purchase_percent;


    //     $sale_price = (int)round($purchase_price + $additional_charges + $cargo);

    //     $sub=substr($sale_price,-2,2);
    //     if($sub == 00){
    //         $sale_price;
    //     }
    //     elseif($sub < 50){
    //        $sale_price = substr_replace($sale_price,50,-2,2);
    //     }
    //     else{
    //         $sale_price += 100;
    //         $minus = substr($sale_price,-2,2);
    //         $sale_price -= $minus;
    //     }

    //     DB::update('update items set  sale_price = ?, updated_at = ?, updated_by = ? where id = ?', [$sale_price,$updated_at,$updated_by,$item_id]);

    // }
    //     }
    //     try{

    //         DB::update('update profit set  percentage = ?, updated_at = ? where id = ?', [$percentage,$updated_at,$id]);

    //         $message = 'Success, profit updated successfully ...!';
    //         $request->session()->flash('success', $message);
    //             return redirect()->action(
    //                 'backend\ProfitController@index'
    //             );

    //     }
    //     catch(Exception $e){

    //         $smessage = 'Fail, Error in profit updating ...!';
    //         $request->session()->flash('fail', $smessage);

    //         return redirect()->action(
    //             'backend\ProfitController@index'
    //         );

    // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        //to select id of faculty which is also equal to user's input id

         $profits = DB::table('profit')->where('id', $id)->first();
         $countries = DB::table('countries')->where('status',1)->get();

         return view('backend_v2.profit.edit', ['countries' => $countries,'profits' => $profits]);
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
        $this->validate($request, [
            'min' => 'required',
            'max'    => 'required',
            'percent' => 'required',

        ]);

        $min                = $request->input('min');
        $max                = $request->input('max');
        $country            = $request->input('countries_id');
        $percentage         = $request->input('percent');

        $updated_at          = date("Y-m-d H:i:s");

        try{

            DB::update('update profit set  min = ?, max = ?,  percent = ?, countries_id = ?, updated_at = ?  where id = ?', [$min,$max,$percentage,$country,$updated_at,$id]);


            $message = 'Success, profit set up updating successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\ProfitController@index'
                );

        }
        catch(Exception $e){

            $smessage = 'Fail, Error in profit updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ProfitController@index'
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
