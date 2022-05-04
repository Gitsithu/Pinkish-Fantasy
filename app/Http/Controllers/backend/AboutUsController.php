<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\Utility as Utility;
use App\about_us;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class AboutUsController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about_us = DB::table('about_us')->first();
        return view('backend_v2.about_us.index')
        ->with('about_us', $about_us);
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
        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        if (Input::hasFile('image') == null) {
            if ($removeImageFlag == 1) {
                $this->validate($request,[
                    'image'=>'required',
                ]);
            }
        }
        $this->validate($request, [
            'title'         => 'required',
            'author'        => 'required',
            'paragraph1'     => 'required',
        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $updated_at = date('Y-m-d H:i:s');

        $path = base_path() . '/public/customerSite/img/';

        $image_file = DB::table('about_us')->where('id', $id)->value('image');

        if (Input::hasFile('image')) {
            //Start Saving Image
            $image_url = Input::file('image');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
            $new_image_file = '/customerSite/img/' . $image_url_name;
            //End Saving Image
            $image_data=DB::select('SELECT image from about_us where id ='.$id);
            $image_path=$image_data[0]->image;
            $path=public_path();
            unlink($path.$image_path);
        } else {
            $new_image_file = $image_file;
        }

        try{
            DB::update('update about_us set updated_at = ?, updated_by = ?, paragraph1 = ?, paragraph2 = ?, paragraph3 = ?, author = ?, title = ?, image = ? where id = ?', [$updated_at,$updated_by,$request->paragraph1,$request->paragraph2,$request->paragraph3,$request->author,$request->title,$new_image_file,$id]);
            $message = 'Success, About Us Data updated successfully ...!';
            $request->session()->flash('success', $message);
            return redirect()->action(
                'backend\AboutUsController@index'
            );
        }
    
        catch(Exception $e){

            $smessage = 'Fail, Error in about us data updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\AboutUsController@index'
            );
        }
    }
}