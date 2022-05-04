<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;
use PDF;
use Excel;
use App\item_specification;
use App\item;
use Illuminate\Support\Facades\Input;
use App\Export\InstockSummaryView;

class InstockReportController extends Controller
{
    public function index()
    {

        $items = DB::select('SELECT i.*,ii.*,c.name as categories_name,co.name as countries_name,b.name as brands_name
        from items_specification as ii
        JOIN items as i
        ON i.id=ii.items_id
        JOIN categories as c
        ON c.id=i.categories_id
        JOIN countries as co
        ON co.id=i.countries_id
        JOIN brands as b
        ON b.id=i.brands_id
        where i.deleted_at is null 
        and i.inactive_at is null
        and i.sale_type = 0');
        $users = DB::select('SELECT * from users where deleted_at is null');
        $type = 0;

        $delete = DB::select('SELECT i.id,i.status from items as i
        Where i.status =2 and curdate() > DATE_ADD(i.inactive_at, interval 2 MONTH)');

        $items_specs = DB::select('SELECT ii.id
        from items_specification as ii
        join items as i
        on i.id = ii.items_id
        Where i.status = 2
        and curdate() > DATE_ADD(i.inactive_at, interval 2 MONTH)');

        $d_count = count($delete);

        $order_s_count = count($items_specs);

        for($j=0;$j<$order_s_count;$j++){
        $order_s_d = $items_specs[$j]->id;

        $od_delete =item_specification::find($order_s_d);
        $od_delete->forceDelete();
        }
        for($i=0;$i<$d_count;$i++){
        $f = $delete[$i]->id;

        $order = item::find($f);
        $order->forceDelete();

        }



        return view('backend_v2.report.instock_report')
        ->with('users',$users)
        ->with('type',$type)
        ->with('items',$items);



    }
    public function search(Request $request)
    {
        $button    = $request->input('button');
        $type      = $request->input('instock_status');
        if($type==0){
        
            $items = DB::select('SELECT i.*,ii.*,c.name as categories_name,co.name as countries_name,b.name as brands_name
            from items_specification as ii
            JOIN items as i
            ON i.id=ii.items_id
            JOIN categories as c
            ON c.id=i.categories_id
            JOIN countries as co
            ON co.id=i.countries_id
            JOIN brands as b
            ON b.id=i.brands_id
            where i.deleted_at is null 
            and i.inactive_at is null
            and i.sale_type = 0');

        }
    
    else{
        $items = DB::select('SELECT i.*,ii.*,c.name as categories_name,co.name as countries_name,b.name as brands_name
        from items_specification as ii
        JOIN items as i
        ON i.id=ii.items_id
        JOIN categories as c
        ON c.id=i.categories_id
        JOIN countries as co
        ON co.id=i.countries_id
        JOIN brands as b
        ON b.id=i.brands_id
        where i.deleted_at is null 
        and i.inactive_at is null
        and i.sale_type = 0
        and ii.qty = 0');

    }
        $users     = DB::select('SELECT * from users where deleted_at is null');
        if($button == 1){
        return view('backend_v2.report.instock_report')
        ->with('users',$users)
        ->with('type',$type)
        ->with('items',$items);
        }
        else{
        
    
    
       
       
            $data = [
                'items' => $items,
                'users' => $users,
                ];

            return Excel::download(new InstockSummaryView($data), 'instock_report.xlsx');

        }
    }


}
