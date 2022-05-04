@php
    $count_sale = DB::table('promotion')
                    ->where('promotion.status',1)
                    ->where('promotion.start_date','<=',Carbon\Carbon::today()->toDateString())
                    ->where('promotion.end_date','>=',Carbon\Carbon::today()->toDateString())
                    ->whereNull('promotion.promo_percent')
                    ->count();
@endphp
<form method="GET" action="{{route('filter_promotions')}}">
    <div class="shop__sidebar laptop_filter">
        <div class="sidebar__sizes">
            <div class="section-title">
                <h4>Promotions</h4>
            </div>
            <div class="size__list">
                <label for="M_all">
                    All Promotions
                    <input type="radio" id="M_all" class="radio" name="promotion" value="All"
                    {{ Session::get('promotion') == 'All' ? 'checked' : 'checked' }}>
                    <span class="checkmark"></span>
                </label>
                @if($count_sale > 0)
                    <label for="M_sale">
                        Sale
                        <input type="radio" id="M_sale" class="radio" name="promotion" value="Sale"
                        {{ Session::get('promotion') == 'Sale' ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                @endif
                @if(!$promotions->isEmpty())
                    @foreach($promotions as $promotion)
                        <label for="M_percent_{{$promotion->promo_percent}}">
                            {{$promotion->promo_percent}}%
                            <input type="radio" id="M_percent_{{$promotion->promo_percent}}" class="radio" name="promotion" value="{{$promotion->promo_percent}}"
                            {{ Session::get('promotion') == $promotion->promo_percent ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    @endforeach
                @endif
            </div>
        </div>
        <input type="submit" class="filter_btn mr-3 to_filter" value="Filter">
    </div>
    <div class="col-lg-12 col-md-12 mobile_filter">
        <div class="section-title text-center">
            <div class="section-title-header float-right">
                <i class="fa fa-bars"></i>
                <h4 class="float-right" data-toggle="modal" data-target="#filter_modal">FILTER</h4>
            </div>
        </div>
    </div>
</form>