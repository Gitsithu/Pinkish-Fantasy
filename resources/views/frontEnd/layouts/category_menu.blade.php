<form method="GET" onsubmit="return validateLaptopFilterForm()" action="{{route('filter')}}">
    @if($byMainCate != "")
        <input type="hidden" id="maincategory_id" name="maincategory_id" value="{{ $byMainCate->id }}">
    @elseif($bySubCate != "")
        <input type="hidden" id="subcategory_id" name="subcategory_id" value="{{ $bySubCate->id }}">
    @elseif($byBrand != "")
        <input type="hidden" id="brand_id" name="brand_id" value="{{ $byBrand->id }}">
    @endif
    <div class="shop__sidebar laptop_filter">
        <div class="sidebar__categories">
            <div class="section-title">
                <h4>Categories</h4>
            </div>
            <div class="categories__accordion">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-heading">
                            <a class="non_sub_cat" href="{{url('/list-products')}}">All Products</a>
                        </div>
                    </div>
                    @foreach($sub_categories as $sub_category)
                        <?php
                            if($byBrand != "") {
                                $categories = DB::table('categories')
                                                ->select('categories.id','categories.name')
                                                ->where('categories.sub_categories_id',$sub_category->id)
                                                ->where('categories.status',1)
                                                ->leftJoin('items','items.categories_id','categories.id')
                                                ->where('items.brands_id',$byBrand->id)
                                                ->groupBy('categories.id')
                                                ->get();
                            } else {
                                $categories=DB::table('categories')->select('id','name')->where([['sub_categories_id',$sub_category->id],['status',1]])->get();
                            }
                        ?>
                        <div class="card">
                            <div class="card-heading">
                                <a data-toggle="collapse" data-target="#cat{{$sub_category->id}}">{{$sub_category->name}}</a>
                            </div>
                            @if(count($categories) > 0)
                                <div id="cat{{$sub_category->id}}" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li>
                                                    <label for="C_{{$category->id}}" class="click">
                                                        <input type="radio" class="laptop_category radio" id="C_{{$category->id}}" name="category" value="{{ $category->id }}"
                                                        {{ Session::get('category') == $category->id ? 'checked' : '' }}>
                                                        {{$category->name}}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="sidebar__sizes">
            <div class="section-title">
                <h4>Product Types</h4>
            </div>
            <div class="size__list">
                <label for="L_all">
                    Both
                    <input type="radio" id="L_all" class="radio" name="product" value="all"
                    {{ Session::get('product') == 'all' ? 'checked' : 'checked' }}>
                    <span class="checkmark"></span>
                </label>
                <label for="L_instock">
                    Instock Only
                    <input type="radio" id="L_instock" class="radio" name="product" value="instock"
                    {{ Session::get('product') == 'instock' ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
                <label for=">L_preorder">
                    Preorder Only
                    <input type="radio" id=">L_preorder" class="radio" name="product" value="preorder"
                    {{ Session::get('product') == 'preorder' ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="sidebar__filter">
            <div class="section-title">
                <h4>Shop by price</h4>
            </div>
            <div class="price_input">
                <input type="number" class="customized_input_number laptop_min_price mb-3" id="minprice" name="minprice"
                onkeypress="return numbersOnly(event)" placeholder="Minimum" value="{{ Session::get('minprice') }}">
                <input type="number" class="customized_input_number laptop_max_price mb-3" id="maxprice" name="maxprice"
                onkeypress="return numbersOnly(event)" placeholder="Maximum" value="{{ Session::get('maxprice') }}">
            </div>
        </div>
        <div class="sidebar__sizes">
            <div class="section-title">
                <h4>Shop by Trends</h4>
            </div>
            <div class="size__list">
                <label for="new_arrival">
                    New Arrival
                    <input type="radio" id="new_arrival" class="laptop_trend radio" name="trend" value="new"
                    {{ Session::get('trend') == 'new' ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
                <label for="best_selling">
                    Best Selling
                    <input type="radio" id="best_selling" class="laptop_trend radio" name="trend" value="best"
                    {{ Session::get('trend') == 'best' ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
                <label for="promotion">
                    Promotion
                    <input type="radio" id="promotion" class="laptop_trend radio" name="trend" value="promotion"
                    {{ Session::get('trend') == 'promotion' ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <input type="submit" class="filter_btn mr-3 to_filter" value="Filter">
        <input type="reset" class="filter_btn reset" value="Clear">
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