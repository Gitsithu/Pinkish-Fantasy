<?php
namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;

class CalculatorController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if($request->has('saleprice')){

            $saleprice = $request->input('saleprice');
        }
        else{
            $saleprice = 0;
        }

        $countries=DB::select('SELECT * from countries where deleted_at is null');
        return view('backend_v2.Calculator.calculator')
        ->with('countries',$countries)
        ->with('saleprice',$saleprice);

    }

    public function store(Request $request)
    {
        $countries_id                = $request->input('countries_id');
        $purchase_price                = $request->input('purchase_price');
        $shipping_fee                = $request->input('shipping_fee');
        $additional_charges                = $request->input('additional_charges');
        $cargo_fee                = $request->input('cargo_fee');
        $profit_id                = $request->input('profit_id');
        $country = DB::table('countries')
                ->where('id',$countries_id)
                ->select('name')
                ->first();
        $country_name = $country->name;
        $exchange_rate = DB::table('countries')
                ->where('countries.id',$countries_id)
                ->select('countries.exchange_rate')
                ->first();

            // Get Profit according to profit min and max
            $check_profits = DB::table('profit')
                            ->where('profit.countries_id',$countries_id)
                            ->get();
            foreach($check_profits as $check_profit) {
                if($check_profit->max != null) {
                    if($check_profit->min <= $purchase_price && $check_profit->max >= $purchase_price) {
                        $profit_percent = DB::table('profit')
                                        ->where('profit.id',$check_profit->id)
                                        ->value('profit.percent');
                    }
                } else {

                    if($check_profit->min <= $purchase_price) {
                        $profit_percent = DB::table('profit')
                                        ->where('profit.id',$check_profit->id)
                                        ->value('profit.percent');
                    }
                }
            }
            $profit = $purchase_price * ($profit_percent/100);
            $mmk_price = ($purchase_price + $profit + $cargo_fee + $shipping_fee) * $exchange_rate->exchange_rate;

        $saleprice = (int)round($mmk_price + $additional_charges);
        $sub=substr($saleprice,-3,3);
        if($sub == 000 || $sub== 500) {
            $saleprice;
        } elseif($sub < 500) {
            $saleprice = substr_replace($saleprice,500,-3,3);
        } else {
            $saleprice += 1000;
            $minus = substr($saleprice,-3,3);
            $saleprice -= $minus;
        }
        $countries=DB::select('SELECT * from countries where deleted_at is null');
        $old_country=DB::select('SELECT * from countries where id='.$countries_id);

        return redirect()->route('admin/calculator', ['saleprice' => $saleprice]);

        // return view('backend_v2.Calculator.calculator')
        // ->with('countries',$countries)
        // ->with('saleprice',$saleprice);
    }
}
