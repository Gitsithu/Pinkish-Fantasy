<?php

namespace App\Http\Controllers;

use App\Profile_model;
use App\User;
use App\Favourite;
use App\Courtry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index(){
        return view('frontEnd.users.login_register');
    }

    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);
        $input_data=$request->all();
        $input_data['password']=Hash::make($input_data['password']);
        $data = User::create($input_data);
        $login_return = $this->login($request);
        return $login_return;
    }

    public function login(Request $request){
        $input_data=$request->all();
        if(Auth::attempt(['email'=>$input_data['email'],'password'=>$input_data['password']])){
            Session::put('frontSession',$input_data['email']);
            if(Auth::user()->role_id == 4) {
                $delete = DB::select('SELECT f.users_id, f.items_id, f.created_at FROM favourites as f
                WHERE f.users_id = '.Auth::user()->id.' AND f.created_at IS NOT NULL AND curdate() > DATE_ADD(f.created_at, interval 30 day)');
                $d_count = count($delete);
                for($i=0; $i<$d_count; $i++) {
                    $del_fav = $delete[$i]->items_id;
                    $favourite = Favourite::where([['users_id', Auth::user()->id], ['items_id', $del_fav]])->forceDelete();
                }
                return redirect("/");
            }else{
                Auth::logout();
                return view('frontEnd.unauthorize.unauthorize');
            }
        }else{
            return back()->with('alert','Your Email or Password is wrong.Try Again!');
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('url');
        return back();
    }

    public function adminlogout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/admin');
    }

    public function account(){
        $user_login=User::where('id',Auth::id())->first();
        $cities=DB::table('cities')->get();
        if($user_login->city_id != null) {
            $townships=DB::table('townships')->where('city_id',$user_login->city_id)->orderBy('name','ASC')->get();
        } else {
            $townships=DB::table('townships')->orderBy('name','ASC')->get();
        }
        return view('frontEnd.users.account',compact('cities','townships','user_login'));
    }

    //update 27/MarchHH
    public function updateprofile(Request $request,$id){
        $this->validate($request,[
            'email'=>'required|string|email',
        ]);
        $input_data=$request->all();
        DB::table('users')->where('id',$id)->update([
                'name'=>$input_data['name'],
                'email'=>$input_data['email'],
                'address'=>$input_data['address'],
                'country'=>$input_data['country'],
                'city_id'=>$input_data['city'],
                'township_id'=>$input_data['township'],
                'phone'=>$input_data['phone']
            ]);
        return back()->with('message','Profile Updated Successfully!');

    }

    public function updatepassword(Request $request,$id){
        $oldPassword=User::where('id',$id)->first();
        $input_data=$request->all();
        if(Hash::check($input_data['password'],$oldPassword->password)){
            $this->validate($request,[
               'newPassword'=>'required|min:6|max:12|confirmed'
            ]);
            $new_pass=Hash::make($input_data['newPassword']);
            User::where('id',$id)->update(['password'=>$new_pass]);
            return back()->with('message','Password Updated Successfully!');
        }else{
            return back()->with('oldpassword','Old Password is Inconrrect!');
        }
    }
}
