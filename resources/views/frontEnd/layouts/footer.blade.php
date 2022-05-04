<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            @php
                $footer_slider = ['footer_slider_1','footer_slider_2','footer_slider_3','footer_slider_4'];
                $ui_footer = DB::table('service_config')->where('status',1)->whereIn('type',$footer_slider)->get();
                $career = ['Career1','Career2','Career3','Career4','Career5'];
                $career_img = DB::table('ui_config')->where('status',1)->whereIn('indexname',$career)->get();
            @endphp
            @if (count($ui_footer) != 0)
                <div class="col-lg-5 col-md-5 col-sm-12 mb-5">
                    <div class="banner__slider footer_banner_slider owl-carousel">
                        @foreach($ui_footer as $footer)
                            <div class="banner__item">
                                <h4 class="mb-2">{{ $footer->title }}</h4>
                                <p>{{ $footer->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="{{ (count($ui_footer) != 0) ? 'col-lg-4 col-md-4' : 'col-lg-6 col-md-6'}} col-sm-12 footer_div">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="{{url('/list-products')}}">Products</a></li>
                        @if (count($career_img) != 0)
                            <li><a href="{{url('/career')}}">Career</a></li>
                        @endif
                        <li><a href="{{url('/about_us')}}">About Us</a></li>
                        <li><a href="{{url('/contact_us')}}">Contact Us</a></li>
                        <li><a href="{{url('/privacy_policy')}}">Privacy Policy</a></li>
                        <li><a href="{{url('/terms_and_conditions')}}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="{{ (count($ui_footer) != 0) ? 'col-lg-3 col-md-3' : 'col-lg-6 col-md-6'}} col-sm-12 footer_div">
                <!-- <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#" class="calculator">
                        <input type="text" class="mb-2" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                    <h6 class="mb-4">EXCHANGE RATE</h6>
                    <?php
                        $countries=DB::table('countries')->select('id','name')->where('status',1)->get();
                    ?>
                    <div class="calculator">
                        <select class="calculate_select mb-2">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        <input type="number" class="calculate_price mb-2 customized_input_number" onkeypress="return numbersOnly(event)" placeholder="Items' Price">
                        <input type="number" class="calculate_result" placeholder="Exchange Rate" readonly="readonly">
                        <button type="submit" class="site-btn calculate">Calculate</button>
                    </div>
                </div> -->
                <div class="footer__about">
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <div class="footer__copyright__text">
                <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="fa fa-heart" aria-hidden="true"></i> by <a href="{{url('/')}}" target="_blank">Pinkish Fantasy</a></p>
            </div>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </div>
</footer>
<!-- Footer Section End -->