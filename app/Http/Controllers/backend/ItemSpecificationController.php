<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\item_specification;
use App\item;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class ItemSpecificationController extends Controller
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
        $item_specifications = DB::select("SELECT distinct s.items_id, i.item_code as item_code , i.image_url1
                        from items_specification as s
                        JOIN items as i
                        ON s.items_id = i.id
                        WHERE s.status = ".$status."
                        GROUP BY s.items_id,i.item_code");

        $item_specifications_size = DB::select("SELECT distinct s.items_id, i.item_code as item_code ,s.size as size, i.image_url1 as image_1
                        from items_specification as s
                        JOIN items as i
                        ON s.items_id = i.id
                        WHERE s.status = ".$status."
                        GROUP BY s.items_id,i.item_code,s.size");

        $item_specifications_2 = DB::select('SELECT s.* , i.item_code as item_code ,i.sale_type as sale_type,i.image_url1 as image_1
        from items_specification as s
        JOIN items as i
        ON s.items_id = i.id
        Where s.status='.$status);

        $delete = DB::select('SELECT i.id,i.inactive_at from items as i
        Where i.inactive_at IS NOT NULL and curdate() > DATE_ADD(i.inactive_at, interval 30 day)');

        $item_s = DB::select('SELECT s.id
        from items_specification as s
        join items as i
        on i.id = s.items_id
        Where i.inactive_at IS NOT NULL
        and curdate() > DATE_ADD(i.inactive_at, interval 30 day)');

        $d_count = count($delete);

        $item_s_count = count($item_s);

        for($j=0;$j<$item_s_count;$j++){
        $item_s_f = $item_s[$j]->id;

        $s_delete =item_specification::find($item_s_f);
        $s_delete->forceDelete();
        }
        for($i=0;$i<$d_count;$i++){
        $f = $delete[$i]->id;

        $item = item::find($f);
        $item->forceDelete();

        }
        return view('backend_v2.item_specification.index')
            ->with('item_specifications_2', $item_specifications_2)
            ->with('item_specifications', $item_specifications)
            ->with('item_specifications_size', $item_specifications_size);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $items=DB::select('SELECT * from items where status = 1 and deleted_at is null');
        return view('backend_v2.item_specification.create')
        ->with('items',$items);
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

            'size' => 'required',
            'color' => 'required',



        ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        try{


            $item           = $request->input('item_id');

            $price    = DB::table('items')->where('id', $item)->value('purchase_price');
            $remark    = DB::table('items')->where('id', $item)->value('remark');
            $size           = $request->input('size');
            $color          = $request->input('color');
            $qty            = $request->input('qty');
            $size_count     = count($size);

            $created_at     = date("Y-m-d H:i:s");
                for($i=0; $i<$size_count; $i++)
                {
                    $s = $size[$i];
                    $c = $color[$i];
                    $q = abs($qty[$i]);


                    DB::insert('insert into items_specification (items_id,size,color,qty,created_at,created_by) values(?,?,?,?,?,?)',
                            [$item,$s,$c,$q,$created_at,$created_by]);
                $item_spec_id = DB::table('items_specification')->max('id');

                    DB::insert('insert into log (items_id,items_specification_id,size,color,qty,price,remark,created_at,created_by) values(?,?,?,?,?,?,?,?,? )',
                            [$item,$item_spec_id,$s,$c,$q,$price,$remark,$created_at,$created_by]);
                }
                $smessage = 'Success, item_specification created successfully ...!';
            $request->session()->flash('success', $smessage);


            return redirect()->action(
                'backend\ItemController@index'
            );



            // for($i=0; $i<$size_count; $i++)
            // {
            //     $s = $size[$i];
            //     $c = $color[$i];
            //     $q = $qty[$i];
            //     $p = $price[$i];

            //     DB::insert('insert into items_specification (items_id,size,color,qty,price,created_at,created_by) values(?,?,?,?,?,?,?)',
            //             [$item,$s,$c,$q,$p,$created_at,$created_by]);
            // $item_spec_id = DB::table('items_specification')->max('id');

            //     DB::insert('insert into log (items_id,items_specification_id,size,color,qty,price,created_at,created_by) values(?,?,?,?,?,?,?,?)',
            //             [$item,$item_spec_id,$s,$c,$q,$p,$created_at,$created_by]);
            // }

             // to alert message when it sucessfully created
            // $smessage = 'Success, item_specification created successfully ...!';
            // $request->session()->flash('success', $smessage);


            // return redirect()->action(
            //     'backend\ItemSpecificationController@index'
            // );
        }

        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in item_specification creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ItemSpecificationController@index'
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

}
    public function archive()
    {
        //
        $item_specifications = DB::select("SELECT distinct s.items_id, i.item_code as item_code
                        from items_specification as s
                        JOIN items as i
                        ON s.items_id = i.id
                        WHERE s.status = 0
                        GROUP BY s.items_id,i.item_code");

        $item_specifications_2 = DB::select('SELECT s.* , i.item_code as item_code
        from items_specification as s
        JOIN items as i
        ON s.items_id = i.id
        Where s.status=0');


        return view('backend_v2.item_specification.archive')
            ->with('item_specifications_2', $item_specifications_2)
            ->with('item_specifications', $item_specifications);

    }

    public function store_preorder(Request $request)
    {
        //
        $this->validate($request, [

            'size' => 'required',
            'color' => 'required',



        ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        try{


            $item           = $request->input('item_id');

            $price    = DB::table('items')->where('id', $item)->value('purchase_price');
            $remark    = DB::table('items')->where('id', $item)->value('remark');
            $size           = $request->input('size');
            $color          = $request->input('color');
            $size_count     = count($size);

            $created_at     = date("Y-m-d H:i:s");
                for($i=0; $i<$size_count; $i++)
                {
                    $s = $size[$i];
                    $c = $color[$i];
                    $q = 0;


                    DB::insert('insert into items_specification (items_id,size,color,qty,created_at,created_by) values(?,?,?,?,?,?)',
                            [$item,$s,$c,$q,$created_at,$created_by]);
                $item_spec_id = DB::table('items_specification')->max('id');

                    DB::insert('insert into log (items_id,items_specification_id,size,color,qty,price,remark,created_at,created_by) values(?,?,?,?,?,?,?,?,? )',
                            [$item,$item_spec_id,$s,$c,$q,$price,$remark,$created_at,$created_by]);
                }
            
                $smessage = 'Success, item_specification created successfully ...!';
            $request->session()->flash('success', $smessage);


            return redirect()->action(
                'backend\ItemController@index'
            );



            // for($i=0; $i<$size_count; $i++)
            // {
            //     $s = $size[$i];
            //     $c = $color[$i];
            //     $q = $qty[$i];
            //     $p = $price[$i];

            //     DB::insert('insert into items_specification (items_id,size,color,qty,price,created_at,created_by) values(?,?,?,?,?,?,?)',
            //             [$item,$s,$c,$q,$p,$created_at,$created_by]);
            // $item_spec_id = DB::table('items_specification')->max('id');

            //     DB::insert('insert into log (items_id,items_specification_id,size,color,qty,price,created_at,created_by) values(?,?,?,?,?,?,?,?)',
            //             [$item,$item_spec_id,$s,$c,$q,$p,$created_at,$created_by]);
            // }

             // to alert message when it sucessfully created
            // $smessage = 'Success, item_specification created successfully ...!';
            // $request->session()->flash('success', $smessage);


            // return redirect()->action(
            //     'backend\ItemSpecificationController@index'
            // );
        }

        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in item_specification creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ItemSpecificationController@index'
            );
        }

    }
    public function delete(Request $request){
        $ids = Input::get('selected_checkboxes');

        if($ids == null){
        $message = 'You need to select at least an item specification!';
        $request->session()->flash('fail', $message);
        return redirect()->action(
            'backend\ItemController@index');


        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        $s_delete =item_specification::find($ids);
        $s_delete->forceDelete();


        }


        $message = 'Success, item_specification deleted successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\ItemController@index');
        }
    }
    }
