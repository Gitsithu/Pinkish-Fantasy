<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\main_category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class MainCategoryController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status = 1;
        $main_categories =  DB::select('SELECT * from main_categories where deleted_at is null and status='.$status);
        $users = DB::select('SELECT * from users where deleted_at is null');


        return view('backend_v2.main_category.index')
            ->with('main_categories', $main_categories)
            ->with('users',$users);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend_v2.main_category.create');
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
            'name' => 'required|unique:main_categories,name,',
            'status' => 'required',

        ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        $name                = $request->input('name');
        $status              = $request->input('status');
        $created_at          = date("Y-m-d H:i:s");

        try{

            DB::insert('insert into main_categories (name,status,created_at,created_by) values(?,?,?,?)',
            [$name,$status,$created_at,$created_by]);

                $message = 'Success, main_category created successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\MainCategoryController@index'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in main_category creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\MainCategoryController@index'
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
        $main_categories = DB::table('main_categories')->where('id', $id)->first();
        return view('backend_v2.main_category.edit', ['main_categories' => $main_categories]);

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
            'name' => 'required|unique:main_categories,name,'. $id .'',
            'status' => 'required',

        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $name                       = $request->input('name');
        $status                     = $request->input('status');
        $updated_at                 = date("Y-m-d H:i:s");

        try{

            DB::update('update main_categories set  name = ?, status = ?, updated_at = ?, updated_by = ? where id = ?', [$name,$status,$updated_at,$updated_by,$id]);
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

            
            $message = 'Success, main_category updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\MainCategoryController@index'
                );

        }
        catch(Exception $e){

            $smessage = 'Fail, Error in main_category updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\MainCategoryController@index'
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
        $main_categories = main_category::find($id);

        // Very Dangerous - Fully Delete Action
        // If no need to destory permanently, u should not use it
        // System will crash in other parts
        // Brand::destroy($id);

        // $status = 0;
        // $updated_at = date("Y-m-d H:i:s");
        // DB::update('update brand set status = ?, updated_at = ? where id = ?', [$status, $updated_at, $id]);

        // https://laravel.com/docs/5.8/eloquent#soft-deleting

        // $notes = brand::withTrashed()->get();
        // $obj = brand::withTrashed()
        //         ->where('id', $id)
        //         ->get();
        // $post = App\Post::withTrashed()->whereId(2)->restore();

        $main_categories->delete();
        if ($main_categories->trashed()) {
            $message = 'Success, ' . $main_categories->name .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\MainCategoryController@index'
            );
        }
        else{

            $message = 'Fail, ' . $main_categories->name .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\MainCategoryController@index'
            );
        }
    }
    public function inactive()
    {
        //

        $main_categories =  DB::select('SELECT * from main_categories where deleted_at is null and status= 0');
        $users = DB::select('SELECT * from users where deleted_at is null');



        return view('backend_v2.main_category.inactive')
            ->with('main_categories', $main_categories)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //
        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least a main category!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\MainCategoryController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("main_categories")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, main categories activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\MainCategoryController@inactive');
        }
      
}
}