<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     * condition sit yamen exmaple login==1 2 3
     */


    // protected $redirectTo = '/backend/dashboard';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function authenticated(Request $request, $user)
    {
        
            
        if($user->role_id == 1 and $user->status == 1) 
        {
           
            return redirect('/admin'); // it will be according to your routes.

        }
        elseif($user->role_id == 2 and $user->status == 1) 
        {
           
            return redirect('/admin'); // it will be according to your routes.

        }
        elseif($user->role_id == 3 and $user->status == 1) 
        {
           
            return redirect('/admin'); // it will be according to your routes.

        }
         else {
            Auth::logout();
            return view('backend_v2.unauthorize.unauthorize');
        }
    }/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginUser($user);
        return redirect('/');


        // $user->token;
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->_registerOrLoginUser($user);
        return redirect('/');



        // $user->token;
    }
    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email','=',$data->email)->first();
        if(!$user){
            $user = new User();
            $user->name= $data->name;
            $user->email= $data->email;
            $user->provider_id= $data->id;
            $user->avatar = $data->avatar;
            $user->save();

        }
        Auth::login($user);
        if($data->email == '' || $data->email == NULL) {
            Session::put('frontSession',$data->name);
        } else {
            Session::put('frontSession',$data->email);
        }


    }



}
