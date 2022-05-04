<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\Utility as Utility;
use App\contact_us;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class ContactUsController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_us = DB::table('contact_us')->first();
        return view('backend_v2.contact_us.index')
        ->with('contact_us', $contact_us);
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
            'address'        => 'required',
            'phone'          => 'required',
            'email'          => 'required'
        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $updated_at = date('Y-m-d H:i:s');

        try{
            DB::update('update contact_us set updated_at = ?, updated_by = ?, email = ?, phone = ?, address = ? where id = ?', [$updated_at,$updated_by,$request->email,$request->phone,$request->address,$id]);
            $message = 'Success, Contact Us Data updated successfully ...!';
            $request->session()->flash('success', $message);
            return redirect()->action(
                'backend\ContactUsController@index'
            );
        }
    
        catch(Exception $e){

            $smessage = 'Fail, Error in contact us data updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ContactUsController@index'
            );
        }
    }
}