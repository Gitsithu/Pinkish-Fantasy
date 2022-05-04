@extends('frontEnd.layouts.master')
@section('title','Login Register Page')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Login / Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="contact my_login">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="contact__form">
                        <h5>Login to your Account</h5>
                        <form action="{{url('/user_login')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="contact__form__input">
                                <input type="email" placeholder="Email" name="email" id="login_email">
                            </div>
                            <div class="contact__form__input">
                                <input type="password" placeholder="Password" name="password">
                                @if(Session::has('alert'))
                                    <span class="text-danger">{{Session::get('alert')}}</span>
                                @endif
                            </div>
                            <!-- <div class="signin__box">
                                <label for="signin">
                                    Keep me Signed in
                                    <input type="checkbox" class="checkbox" id="signin">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            <button type="submit" class="site-btn">Login</button>

                            <div class="row">
                                <div class="col-lg-5"><hr></div>
                                <div class="col-lg-2">or</div>
                                <div class="col-lg-5"><hr></div>
                            </div>

                            <a href="{{route('login.google')}}" class="site-btn google-btn" style="background-color:#DB4437!important;color:white!important;">Google</a>

                            <a href="{{route('login.facebook')}}" class="site-btn" style="background-color:#4267B2!important;color:white!important;">Facebook</a>

                        </form>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 register-or">
                    <h5 class="text-center">OR</h5>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="contact__form">
                        <h5>New User Signup!</h5>
                        <form action="{{url('/register_user')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="contact__form__input">
                                <input type="text" placeholder="Full Name" name="name" value="{{old('name')}}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="contact__form__input">
                                <input type="email" placeholder="Email Address" name="email" value="{{old('email')}}">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="contact__form__input">
                                <input type="password" placeholder="Password" name="password" value="{{old('password')}}">
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                            <div class="contact__form__input">
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" value="{{old('password_confirmation')}}">
                                <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                            </div>
                            <button type="submit" class="site-btn">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
