<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\Utility as Utility;
use App\uiconfig;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class UiConfigController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ui_imgs = DB::select('SELECT id,indexname,img_url,status,created_by,updated_by,created_at,updated_at
                        from ui_config where status = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');
   
            return view('backend_v2.ui_config.index')
            ->with('ui_imgs', $ui_imgs)
            ->with('users',$users);

            }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $ui_config = DB::table('ui_config')->where('id', $id)->first();
        return view('backend_v2.ui_config.edit', ['ui_config' => $ui_config]);

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
            'remark'                => 'max:255',
        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $updated_at = date('Y-m-d H:i:s');
        $status = $request->input('status');

        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/customerSite/img/';
        $remove_old_image = false;

        $image_file = DB::table('ui_config')->where('id', $id)->value('img_url');

        if (Input::hasFile('img_url')) {
            //Start Saving Image
            $image_url = Input::file('img_url');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
            $remove_old_image = true;
            $image_files = '/customerSite/img/' . $image_url_name;
            //End Saving Image
        } else {
            if ($removeImageFlag == 1) {
                $image_files = "";
                $remove_old_image = true;
                $image_data=DB::select('SELECT img_url from ui_config where id ='.$id);
                $image_path=$image_data[0]->img_url;
                $path=public_path();
                unlink($path.$image_path);
            }
            else{
                $image_files=$image_file;
            }
        }

        try{
            DB::update('update ui_config set img_url = ?, status = ?, updated_by = ?, updated_at = ? where id = ?', [$image_files,$status,$updated_by,$updated_at,$id]);
            if ($remove_old_image == true) {
                Utility::removeImage($image_file);
            }
            $message = 'Success, image updated successfully ...!';
            $request->session()->flash('success', $message);
                return redirect()->action(
                    'backend\UiConfigController@index'
                );

        }
    
        catch(Exception $e){

            $smessage = 'Fail, Error in image updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\UiConfigController@index'
            );

    }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive()
    {
        //

        $ui_imgs=DB::select('SELECT * from ui_config where deleted_at is null and status=0');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.ui_config.inactive')
            ->with('ui_imgs', $ui_imgs)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //

        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least one Ui_config!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\UiConfigController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("ui_config")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, Ui_config activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\UiConfigController@inactive');
        }
    }
}