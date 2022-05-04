@extends('frontEnd.layouts.master')
@section('title','Privacy Policy')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Privacy Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Privacy Policy Section Begin -->
    <section class="product spad pt-5">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <div class="m-auto section-title-header">
                        <h4 class="mb-3">Privacy Policy</h4>
                    </div>
                </div>
            </div>
            <div class="row property__gallery">
                <div class="col-lg-12 mb-2">
                    <h5><b>What personal information about customers does Pinkish Fantasy collect?</b></h5>
                </div>
                <div class="col-lg-12 pl-5">
                    <ul>
                        <li>
                            <b class="mb-2">Information You Give Us</b>
                            <p>We receive and store any information you provide in relation to our services. You can choose not to provide certain information, but then you might not be able to take advantage of many of our services.</p>
                        </li>
                        <li>
                            <b class="mb-2">Automatic Information</b>
                            <p>We automatically collect and store certain types of information about your use of our services.</p>
                        </li>
                        <li>
                            <b class="mb-2">Information from Other Sources</b>
                            <p>We might receive information about you from other sources, such as updated delivery and address information from our carriers, which we use to correct our records and deliver your next purchase more easily.</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-12 mb-2">
                    <h5 class="mb-2"><b>Do we share your personal information?</b></h5>
                    <p>We are not in the business of selling our customers’ personal information to others. Our customers’ information is an important part of our business.</p>
                </div>
                <div class="col-lg-12 mb-2">
                    <h5 class="mb-2"><b>What information can I access?</b></h5>
                    <p>You can access your information, including your name, address, payment options, profile information, prime membership, household settings, and purchase history.</p>
                </div>
                <div class="col-lg-12 mb-2">
                    <h5 class="mb-2"><b>Are children allowed to use Pinkish Fantasy services?</b></h5>
                    <p>We do not sell products for purchase by children. If you are under 18, you may use our services only with the involvement of a parent or guardian. We do not knowingly collect personal information from children under the age of 13 without the consent of the child’s parent or guardian.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Privacy Policy Section End -->
@endsection