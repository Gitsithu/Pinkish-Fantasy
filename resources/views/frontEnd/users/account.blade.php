@extends('frontEnd.layouts.master')
@section('title','My Account Page')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>My Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="contact my_account">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success text-center" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-5 col-md-5 section-title">
                    <div class="contact__form">
                        <h5>Account Profile</h5>
                        <form action="{{url('/update-profile',$user_login->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{method_field('PUT')}}

                            <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name', $user_login->name)}}" placeholder="Name">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                <input type="text" class="form-control" value="{{old('email', $user_login->email)}}" name="email" id="email" placeholder="Your Email Address">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="form-group {{$errors->has('address')?'has-error':''}}">
                                <textarea class="form-control" name="address" id="address" placeholder="Enter Your Physical Address" cols="30" rows="10">{{old('address', $user_login->address)}}</textarea>
                                <span class="text-danger">{{$errors->first('address')}}</span>
                            </div>
                            <div class="form-group {{$errors->has('country')?'has-error':''}}">
                                <input type="text" class="form-control" name="country" value="{{old('country', $user_login->country)}}" id="country" placeholder="Enter Your Country">
                                <span class="text-danger">{{$errors->first('country')}}</span>
                            </div>
                            <div class="form-group">
                                <select name="city" id="city" class="form-control">
                                    <option value="0">Choose Your City</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{ old('city', $user_login->city_id)==$city->id ? 'selected':''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="township" id="township" class="form-control">
                                    <option value="0">Choose Your Township</option>
                                    @foreach($townships as $township)
                                        <option value="{{$township->id}}" {{ old('township', $user_login->township_id)==$township->id ? 'selected':''}}>{{$township->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{$errors->has('phone')?'has-error':''}}">
                                <input type="text" class="form-control" name="phone" value="{{old('phone', $user_login->phone)}}" id="phone" placeholder="Mobile Phone Number">
                                <span class="text-danger">{{$errors->first('phone')}}</span>
                            </div>
                            <button type="submit" class="site-btn" style="float: right;">Update Profile</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 section-title">
                    <h5 class="text-center">OR</h5>
                </div>
                <div class="col-lg-5 col-md-5 section-title">
                    <div class="contact__form">
                        <h5>Update New Password</h5>
                        <form action="{{url('/update-password',$user_login->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{method_field('PUT')}}

                            <div class="form-group {{$errors->has('password')?'has-error':''}}">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Old Password">
                                @if(Session::has('oldpassword'))
                                    <span class="text-danger">{{Session::get('oldpassword')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('newPassword')?'has-error':''}}">
                                <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password">
                                <span class="text-danger">{{$errors->first('newPassword')}}</span>
                            </div>
                            <div class="form-group {{$errors->has('newPassword_confirmation')?'has-error':''}}">
                                <input type="password" class="form-control" name="newPassword_confirmation" id="newPassword_confirmation" placeholder="Confirm Password">
                                <span class="text-danger">{{$errors->first('newPassword_confirmation')}}</span>
                            </div>

                            <button type="submit" class="site-btn" style="float: right;">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).on('change', '#city', function() {
            var city = document.getElementById('city').value;
            getTownships(city);
        })

        function getTownships(city) {
            $.ajax({
                type:'get',
                url:'/get-townships',
                data:{city:city},
                success:function(resp) {
                    var arr = JSON.parse(resp);
                    var html = '';
                    for(let i = 0; i < arr.length; i++){
                        html +=`<option value="${arr[i]["id"]}">${arr[i]["name"]}</option>`;
                    }
                    $('#township').html(html);
                }
            })
        }
    </script>
@endsection