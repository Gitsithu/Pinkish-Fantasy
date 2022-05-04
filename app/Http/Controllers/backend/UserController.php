<?php

namespace App\Http\Controllers\backend;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use App\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Core\Utility as Utility;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;

class UserController extends Controller
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
        $loginUser = Auth::user();
        if($loginUser->role_id == 1 || $loginUser->role_id == 2){

        $users=DB::select('SELECT * from users where deleted_at is null and role_id = 3');

       return view('backend_v2.user.index')
        ->with('users',$users);
    }
    else{
        return view('backend_v2.unauthorize.unauthorize');
    }
}
    public function customer()
    {
        // to select data from brand table where deleted-at is null and status = active
        $loginUser = Auth::user();
        if($loginUser->role_id == 1 || $loginUser->role_id == 2){

        $customers = DB::select('SELECT * from users where deleted_at is null and role_id > 3');

       return view('backend_v2.user.customer')
        ->with('customers',$customers);
    }
    else{
        return view('backend_v2.unauthorize.unauthorize');
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loginUser = Auth::user();
        if($loginUser->role_id == 1 || $loginUser->role_id == 2){

        return view('backend_v2.user.create');
    }

    else{
        return view('backend_v2.unauthorize.unauthorize');
    }
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

            'name'                  => 'required',
            'email'                 => 'required',
            'password_confirmation' => 'required',
            'password'              => 'required|min:8|confirmed',
            'phone'                 => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'address'               => 'required',
        ]);

        try{
            $loginUser = Auth::user();
            $created_by = $loginUser->id;

            $name                 = $request->input('name');
            $email                    = $request->input('email');
            $password                 = bcrypt($request->input('password'));
            $phone                    = $request->input('phone');
            $address                  = $request->input('address');
            $role_id                  = $request->input('role');
             // create the images file path to store the submission images
            $image_url_name = "";
            //Start Saving Image
            $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
            $path = base_path() . '/public/user_images/';

            if (Input::hasFile('avatar')) {
                $image_url = Input::file('avatar');
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
            $image_file = '/user_images/' . $image_url_name;
            $created_at         = date("Y-m-d H:i:s");

            DB::insert('insert into users (name,email,password,phone,address,role_id,avatar,created_at,created_by) values(?,?,?,?,?,?,?,?,?)',
                        [$name,$email,$password,$phone,$address,$role_id,$image_file,$created_at,$created_by]);

            // to alert message when it sucessfully created
            $smessage = 'Success, user created successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\UserController@index'
            );
                    }
        catch(Exception $e){

            // to alert message when it fail creating
            $smessage = 'Fail, Error in user creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\UserController@index'
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password($id)
    {
        $e = Crypt::decrypt($id);
        $users = DB::table('users')->where('id', $e)->first();
        return view('backend_v2.user.password', ['users' => $users]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request){
        $this->validate($request,[
            'current_password' => ['required', new MatchOldPassword],
            'password'=>'required|min:8|confirmed'

         ]);
        $id = Auth::user()->id;


            DB::table("users")->where('id',$id)->update(['password' => bcrypt($request->input('password'))]);

            $smessage = 'Success, password updated successfully ...!';
            $request->session()->flash('success', $smessage);

            // to return view
            return redirect()->action(
                'AdminController@index'
            );


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id)
    {
        //to validate form
        $id = Crypt::decrypt($id);
        $loginUser = Auth::user();
        $updated_by = $loginUser->id;
        $status     = 0;
        $updated_at = date("Y-m-d H:i:s");

        DB::update('update users set  status = ?, updated_at = ?, updated_by = ? where id = ?', [$status,$updated_at,$updated_by,$id]);

                $smessage = 'Success, user deactivated successfully ...!';
                $request->session()->flash('fail', $smessage);

                // to return view
                return redirect()->action(
                    'backend\UserController@index'
                );
    }





 }


