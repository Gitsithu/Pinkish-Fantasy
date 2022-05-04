<!-- Banner Section Begin -->
<section class="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12 m-auto p-0">
                <div class="banner__slider owl-carousel">
                    @foreach($slider_img as $slider)
                        <div class="banner__item">
                            <img src="{{ url($slider->img_url) }}" class="banner__img">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->