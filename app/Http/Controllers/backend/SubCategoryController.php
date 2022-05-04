<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\sub_category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class SubCategoryController extends Controller
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
        $sub_categories = DB::select('SELECT s.* , m.name as main_category_name
                        from sub_categories as s
                        JOIN main_categories as m
                        ON s.main_categories_id = m.id
                        Where s.status='.$status);
        $users = DB::select('SELECT * from users where deleted_at is null');


        return view('backend_v2.sub_category.index')
            ->with('sub_categories', $sub_categories)
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
        $main_categories=DB::select('SELECT * from main_categories where status = 1 and deleted_at is null');
        return view('backend_v2.sub_category.create')
        ->with('main_categories',$main_categories);
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
            'name' => 'required|unique:sub_categories,name,',
            'status' => 'required',
            'main_categories_id' => 'required',


        ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        $name                = $request->input('name');
        $main_categories_id  = $request->input('main_categories_id');
        $status              = $request->input('status');
        $created_at          = date("Y-m-d H:i:s");

        try{

        DB::insert('insert into sub_categories (name,main_categories_id,status,created_at,created_by) values(?,?,?,?,?)',
        [$name,$main_categories_id,$status,$created_at,$created_by]);


                $message = 'Success, sub_category created successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\SubCategoryController@index'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in sub_category creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\SubCategoryController@index'
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
        $sub_categories = DB::table('sub_categories')->where('id', $id)->first();
        $main_categories = DB::select('select * from main_categories where status = 1');

        return view('backend_v2.sub_category.edit', ['sub_categories' => $sub_categories,'main_categories' => $main_categories]);

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
            'name' => 'required|unique:sub_categories,name,'. $id .'',
            'status' => 'required',

        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $name                       = $request->input('name');
        $main_categories_id  = $request->input('main_categories_id');
        $status                     = $request->input('status');
        $updated_at                 = date("Y-m-d H:i:s");

        try{

            DB::update('update sub_categories set  name = ?, main_categories_id = ?, status = ?, updated_at = ?, updated_by = ? where id = ?', [$name,$main_categories_id,$status,$updated_at,$updated_by,$id]);

            $message = 'Success, sub_category updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\SubCategoryController@index'
                );

        }
        catch(Exception $e){

            $smessage = 'Fail, Error in sub_category updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\SubCategoryController@index'
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
        $sub_categories = main_category::find($id);

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

        $sub_categories->delete();
        if ($sub_categories->trashed()) {
            $message = 'Success, ' . $sub_categories->name .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\SubCategoryController@index'
            );
        }
        else{

            $message = 'Fail, ' . $sub_categories->name .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\SubCategoryController@index'
            );
        }
    }
    public function inactive()
    {
        //

        $sub_categories =  DB::select('SELECT s.* , m.name as main_category_name
        from sub_categories as s
        JOIN main_categories as m
        ON s.main_categories_id = m.id
        Where s.status= 0');
        $users = DB::select('SELECT * from users where deleted_at is null');



        return view('backend_v2.sub_category.inactive')
            ->with('sub_categories', $sub_categories)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //
        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least a sub category!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\SubCategoryController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("sub_categories")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, sub categories activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\SubCategoryController@inactive');
        }
    }
}
