<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
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
        $categories = DB::select('SELECT c.* , s.name as sub_category_name
                        from categories as c
                        JOIN sub_categories as s
                        ON c.sub_categories_id = s.id
                        Where c.status='.$status);

        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.category.index')
            ->with('categories', $categories)
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
        $sub_categories=DB::select('SELECT * from sub_categories where status = 1 and deleted_at is null');
        return view('backend_v2.category.create')
        ->with('sub_categories',$sub_categories);
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
            'sub_categories_id' => 'required',

        ]);
        $loginUser = Auth::user();
        $created_by = $loginUser->id;

        $name                = $request->input('name');
        $sub_categories_id   = $request->input('sub_categories_id');
        $status              = $request->input('status');
        $created_at          = date("Y-m-d H:i:s");

        try{

        DB::insert('insert into categories (name,sub_categories_id,status,created_at,created_by) values(?,?,?,?,?)',
        [$name,$sub_categories_id,$status,$created_at,$created_by]);


                $message = 'Success, category created successfully ...!';
                $request->session()->flash('success', $message);


                return redirect()->action(
                    'backend\CategoryController@index'
                );



        }
        catch(Exception $e){

            $smessage = 'Fail, Error in category creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\CategoryController@index'
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
        $categories = DB::table('categories')->where('id', $id)->first();
        $sub_categories = DB::select('select * from sub_categories where status = 1');
        return view('backend_v2.category.edit', ['sub_categories' => $sub_categories,'categories' => $categories]);

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
            'name' => 'required',
            'status' => 'required',

        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;

        $name                       = $request->input('name');
        $sub_categories_id          = $request->input('sub_categories_id');
        $status                     = $request->input('status');
        $updated_at                 = date("Y-m-d H:i:s");

        try{
            if($status == 0){
                $inactive_at          = date("Y-m-d");
            DB::update('update categories set  name = ?, sub_categories_id = ?, status = ?, inactive_at = ?, updated_at = ?, updated_by = ? where id = ?', [$name,$sub_categories_id,$status,$inactive_at,$updated_at,$updated_by,$id]);
            DB::update('update items set status = ?, inactive_at = ?, updated_at = ?, updated_by = ? where categories_id = ?', [0,$inactive_at,$updated_at,$updated_by,$id]);
            $items = DB::table('items')->where('categories_id', $id)->get();

            foreach($items as $ids){
                DB::table("items_specification")->where('items_id',$ids->id)->update(['status' => 0]);
            }
            $message = 'Success, category updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\CategoryController@index'
                );
            }
            else{
                DB::update('update categories set  name = ?, sub_categories_id = ?, status = ?, updated_at = ?, updated_by = ? where id = ?', [$name,$sub_categories_id,$status,$updated_at,$updated_by,$id]);
                DB::update('update items set status = ?, updated_at = ?, updated_by = ? where categories_id = ?', [$status,$updated_at,$updated_by,$id]);

                $message = 'Success, category updated successfully ...!';
                $request->session()->flash('success', $message);
                    return redirect()->action(
                        'backend\CategoryController@index'
                    );

            }
        }
        catch(Exception $e){

            $smessage = 'Fail, Error in category updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\CategoryController@index'
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
        $categories = category::find($id);

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

        $categories->delete();
        if ($categories->trashed()) {
            $message = 'Success, ' . $categories->name .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\CategoryController@index'
            );
        }
        else{

            $message = 'Fail, ' . $categories->name .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\CategoryController@index'
            );
        }
    }
    public function inactive()
    {


        $categories = DB::select('SELECT c.* , s.name as sub_category_name
        from categories as c
        JOIN sub_categories as s
        ON c.sub_categories_id = s.id
        Where c.status=0');

        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.category.inactive')
            ->with('categories', $categories)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //

        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least a category!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\CategoryController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("categories")->where('id',$ids)->update(['status' => 1]);
        DB::table("items")->where('categories_id',$ids)->update(['status' => 1]);
        $items = DB::table('items')->where('categories_id', $ids)->get();
        foreach($items as $idss){
            DB::table("items_specification")->where('items_id',$idss->id)->update(['status' => 1]);
        }

        }


        $message = 'Success, categories activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\CategoryController@inactive');
        }
    }

}
