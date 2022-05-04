<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Core\Utility as Utility;
use App\banks_info;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class BankInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delete = DB::select('SELECT b.id from banks_info as b
            Where b.deleted_at IS NULL and b.status = 0 and curdate() > DATE_ADD(b.updated_at, interval 7 day)');
        $d_count = count($delete);
        for($i = 0; $i < $d_count; $i++) {
            $id = $delete[$i]->id;
            $delete_banks_info = Banks_info::where('id',$id)->forceDelete();
        }
        $banks_info = DB::select('SELECT id,bank,account_name,account_no,status,created_by,updated_by,created_at,updated_at from banks_info where status = 1');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.banks_info.index')
        ->with('banks_info', $banks_info)
        ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend_v2.banks_info.create');
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
            'bank'                => 'max:100',
            'account_name'        => 'required|max:100',
            'account_no'          => 'required|max:20'
        ]);

        try{
            $status = 1;
            $loginUser = Auth::user();
            $created_by = $loginUser->id;
            $created_at         = date("Y-m-d H:i:s");

            DB::insert('insert into banks_info (bank,account_name,account_no,status,created_at,created_by) values(?,?,?,?,?,?)',
                        [$request->bank,$request->account_name,$request->account_no,$status,$created_at,$created_by]);

            // to alert message when it sucessfully created
            $smessage = 'Success, Bank Information created successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\BankInformationController@index'
            );
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in creating bank information...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\BankInformationController@index'
            );
        }

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
        $bank_info = DB::table('banks_info')->where('id', $id)->first();
        return view('backend_v2.banks_info.edit', ['bank_info' => $bank_info]);
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
            'bank'                => 'max:100',
            'account_name'        => 'required|max:100',
            'account_no'          => 'required|max:20'
        ]);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $updated_at = date('Y-m-d H:i:s');

        try{
            DB::update('update banks_info set updated_at = ?, updated_by = ?, status = ?, account_no = ?, account_name = ?, bank = ? where id = ?', [$updated_at,$updated_by,$request->status,$request->account_no,$request->account_name,$request->bank,$id]);
            $message = 'Success, Bank Information is updated successfully ...!';
            $request->session()->flash('success', $message);
            return redirect()->action(
                'backend\BankInformationController@index'
            );
        }
    
        catch(Exception $e){

            $smessage = 'Fail, Error in bank information updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\BankInformationController@index'
            );
        }
    }
    public function inactive()
    {
        //

        $banks_info=DB::select('SELECT * from banks_info where deleted_at is null and status=0');
        $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend_v2.banks_info.inactive')
            ->with('banks_info', $banks_info)
            ->with('users',$users);


    }
    public function activate(Request $request)
    {
        //

        $ids = Input::get('selected_checkboxes');
        if($ids == null){
        $message = 'You need to select at least one Bank Information!';
        $request->session()->flash('fail', $message);

        return redirect()->action(
            'backend\BankInformationController@inactive'
        );

        }
        else{
        $new_string = explode(',', $ids);
        foreach ($new_string as $ids) {
        DB::table("banks_info")->where('id',$ids)->update(['status' => 1]);

        }


        $message = 'Success, Bank Information activated successfully ...!';
        $request->session()->flash('success', $message);
        return redirect()->action(
            'backend\BankInformationController@inactive');
        }
    }
}