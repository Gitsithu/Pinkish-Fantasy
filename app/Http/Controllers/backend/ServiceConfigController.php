<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\Utility as Utility;
use App\serviceconfig;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class ServiceConfigController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_config = DB::select('SELECT id,type,title,description,status,created_by,updated_by,created_at,updated_at from service_config where status = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.service_config.index')
        ->with('service_config', $service_config)
        ->with('users',$users);
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
        $service_config = DB::table('service_config')->where('id', $id)->first();
        return view('backend_v2.service_config.edit', ['service_config' => $service_config]);
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
            'title'                => 'required|max:20',
            'description'          => 'required|max:190'
        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $updated_at = date('Y-m-d H:i:s');

        try{
            DB::update('update service_config set updated_at = ?, updated_by = ?, status = ?, description = ?, title = ? where id = ?', [$updated_at,$updated_by,$request->status,$request->description,$request->title,$id]);
            $message = 'Success, service data updated successfully ...!';
            $request->session()->flash('success', $message);
            return redirect()->action(
                'backend\ServiceConfigController@index'
            );
        }
    
        catch(Exception $e){

            $smessage = 'Fail, Error in service data updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ServiceConfigController@index'
            );
        }
    }
    public function inactive()
    {
        //

        $service_config=DB::select('SELECT * from service_config where deleted_at is null and status=0');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.service_config.inactive')
            ->with('service_config', $service_config)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //

        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least one Service_config!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\ServiceConfigController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("service_config")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, Service_config activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\ServiceConfigController@inactive');
        }
    }
}