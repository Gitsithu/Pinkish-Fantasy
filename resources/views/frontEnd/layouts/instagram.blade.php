<div class="container-fluid">
    @if (count($insta_img) == 2)
        <div class="row two_insta">
    @elseif (count($insta_img) == 3)
        <div class="row three_insta">
    @elseif (count($insta_img) == 4)
        <div class="row four_insta">
    @elseif (count($insta_img) == 5)
    <div class="row five_insta">
    @else
        <div class="row">
    @endif
        @foreach($insta_img as $img)
            @if (count($insta_img) == 1)
                <div class="col-lg-2 col-md-4 col-sm-4 p-0 mobile-instagram {{ (count($insta_img) == 1) ? 'single_insta' : '' }}">
            @elseif (count($insta_img) == 6 || count($insta_img) == 5)
                <div class="col-lg-2 col-md-4 col-sm-4 p-0 mobile-instagram">
            @else
                <div class="col-lg-3 col-md-4 col-sm-4 p-0 mobile-instagram">
            @endif
                <div class="instagram__item set-bg" data-setbg="{{asset($img->img_url)}}">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/pinkish_fantasy/" target="blank">@ pinkish_fantasy</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>