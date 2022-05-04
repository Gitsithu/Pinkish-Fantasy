<?php

namespace App\Http\Controllers\backend;
use Auth;
use DB;
use App\brand;
use Illuminate\Http\Request;
use App\Core\Utility as Utility;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BrandController extends Controller
{
    //
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // to select data from brand table where deleted-at is null and status = active
        $status=1;
        $brands=DB::select('SELECT * from brands where deleted_at is null and status='.$status);
        $users = DB::select('SELECT * from users where deleted_at is null');
       return view('backend_v2.brand.index')
        ->with('brands',$brands)
        ->with('users',$users);


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend_v2.brand.create');
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

            'name' => 'required|unique:brands',



        ]);

        try{
            $loginUser = Auth::user();
            $created_by = $loginUser->id;

            $name               = $request->input('name');
             // create the images file path to store the submission images
            $image_url_name = "";
            //Start Saving Image
            $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
            $path = base_path() . '/public/brand_images/';

            if (Input::hasFile('image_url')) {
                $image_url = Input::file('image_url');
                $image_url_name_original = Utility::getImage($image_url);
                $image_url_ext = Utility::getImageExt($image_url);
                $image_url_name = uniqid() . "." . $image_url_ext;
                $image = Utility::resizeImage($image_url, $image_url_name, $path);
            } else {
                $image_url_name = "";
            }

            if ($removeImageFlag == 1) {
                $image_url_name = "";
            }
            //End Saving Image 1
            $image_file = '/brand_images/' . $image_url_name;
            $created_at         = date("Y-m-d H:i:s");
            $status             = $request->input('status');
            $created_at         = date("Y-m-d H:i:s");

            DB::insert('insert into brands (name,image,status,created_at,created_by) values(?,?,?,?,?)',
                        [$name,$image_file,$status,$created_at,$created_by]);

            // to alert message when it sucessfully created
            $smessage = 'Success, brand created successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\BrandController@index'
            );
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in brand creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\BrandController@index'
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
        $id = Crypt::decrypt($id);
        //to select id of faculty which is also equal to user's input id

         $brands = DB::table('brands')->where('id', $id)->first();
         return view('backend_v2.brand.edit', ['brands' => $brands]);
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

            'name' => 'required|unique:brands,name,'. $id .'',
            'status' => 'required',



        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $name                       = $request->input('name');
        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/brand_images/';
        $remove_old_image = false;

        $image_file = DB::table('brands')->where('id', $id)->value('image');
        $status             = $request->input('status');
        $updated_at         = date("Y-m-d H:i:s");

        try{
            if (Input::hasFile('image_url')) {
                //Start Saving Image
                $image_url = Input::file('image_url');
                $image_url_name_original = Utility::getImage($image_url);
                $image_url_ext = Utility::getImageExt($image_url);
                $image_url_name = uniqid() . "." . $image_url_ext;
                $image = Utility::resizeImage($image_url, $image_url_name, $path);
                $remove_old_image = true;
                $image_files = '/brand_images/' . $image_url_name;

                $status             = $request->input('status');
                $updated_at         = date("Y-m-d H:i:s");
            //End Saving Image
            } else {
                if ($removeImageFlag == 1) {
                    $image_files = "";
                    $remove_old_image = true;
                    $image_data=DB::select('SELECT image from brands where id ='.$id);
                    $image_path=$image_data[0]->image;
                    $path=public_path();
                    unlink($path.$image_path);
                }
                else{
                    $image_files=$image_file;
                }
            }

            // to create the folder path when it save images


                DB::update('update brands set  name = ?,  image = ?, status = ?, updated_at = ?, updated_by = ? where id = ?', [$name,$image_files,$status,$updated_at,$updated_by,$id]);
                if ($remove_old_image == true) {
                    Utility::removeImage($image_file);
                }
                $smessage = 'Success, brand updated successfully ...!';
                $request->session()->flash('success', $smessage);

                // to return view
                return redirect()->action(
                    'backend\BrandController@index'
                );
            }



            catch(Exception $e){

            // to show the alert box
            $smessage = 'Fail, Error in brand updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\BrandController@index'
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
        // to delect the data from database
        $brands = brand::find($id);
        $brands->delete();
        if ($brands->trashed()) {
            $message = 'Success, ' . $brands->type .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\BrandController@index'
            );
        }
        else{

            $message = 'Fail, ' . $brands->type .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\BrandController@index'
            );
        }
    }
    public function inactive()
    {
        //

        $brands=DB::select('SELECT * from brands where deleted_at is null and status=0');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.brand.inactive')
            ->with('brands', $brands)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //

        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least a brand!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\BrandController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("brands")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, brand activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\BrandController@inactive');
        }
    }



    }
