@extends('frontEnd.layouts.master')
@section('title','List Products')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <?php
                            if($byMainCate != ""){
                                if($byCate != "") {
                                    echo '<a href="'.route("maincat",$byMainCate->id).'">'.$byMainCate->name.'</a>';
                                    echo '<span>'.$byCate->name.'</span>';
                                } else {
                                    echo '<span>'.$byMainCate->name.'</span>';
                                }
                            }elseif($bySubCate != ""){
                                if($byCate != "") {
                                    echo '<a href="'.route("subcat",$bySubCate->id).'">'.$bySubCate->name.'</a>';
                                    echo '<span>'.$byCate->name.'</span>';
                                } else {
                                    echo '<span>'.$bySubCate->name.'</span>';
                                }
                            }elseif($byBrand != ""){
                                if($byBrand->name == "No Brand") {
                                    if($byCate != "") {
                                        echo '<a href="'.route("brand",$byBrand->id).'">Brand</a>';
                                        echo '<span>'.$byCate->name.'</span>';
                                    } else {
                                        echo '<span>Brand</span>';
                                    }
                                } else {
                                    if($byCate != "") {
                                        echo '<a href="'.route("brand",$byBrand->id).'">'.$byBrand->name.'</a>';
                                        echo '<span>'.$byCate->name.'</span>';
                                    } else {
                                        echo '<span>'.$byBrand->name.'</span>';
                                    }
                                }
                            }else{
                                if($byCate != "") {
                                    echo '<span>'.$byCate->name.'</span>';
                                } else {
                                    echo '<span>Products</span>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <!-- Alert begin -->
                    @if(Session::has('success'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        </div>
                    @endif
                <!-- Alert end -->
                <div class="col-lg-3 col-md-3 mb-5">
                    @include('frontEnd.layouts.category_menu')
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @if(count($items) != 0)
                            @foreach($items as $item)
                                @if($item->status == 1)
                                <?php
                                    $id = Crypt::encrypt($item->id);
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 mobile_product">
                                        <div class="product__item">
                                            <div class="product__item__pic list_product_item set-bg" data-setbg="{{url($item->image_url1)}}">
                                                <ul class="product__hover">
                                                    <li><a href="{{url($item->image_url1)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                    @if(Auth::check())
                                                        <?php
                                                            $favourite = DB::table('favourites')->where([['users_id', Auth::user()->id], ['items_id', $item->id]])->first();
                                                        ?>
                                                        @if($favourite == "")
                                                            <li><a href="{{url('/add_favourite',$item->id)}}"><span class="icon_heart_alt"></span></a></li>
                                                        @endif
                                                    @endif
                                                    <li>
                                                        @if(isset($item->promotion_id))
                                                            <form method="GET" action="{{url('/item-detail',$id)}}">
                                                                <input type="hidden" name="promotion_id" value="{{$item->promotion_id}}">
                                                                <a onclick="this.closest('form').submit();return false;"><span class="icon_document_alt"></span></a>
                                                            </form>
                                                        @else
                                                            <a href="{{url('/item-detail',$id)}}"><span class="icon_document_alt"></span></a>
                                                        @endif
                                                    </li>
                                                </ul>
                                                @if(isset($item->promotion_id))
                                                    @if($item->promo_amount == null)
                                                        <div class="label new">{{ $item->promo_percent }}%</div>
                                                    @else
                                                        <div class="label new">Sale</div>
                                                    @endif
                                                @else
                                                    @if(Session::get('trend') == "new")
                                                        <div class="label new">new</div>
                                                    @elseif(Session::get('trend') == "best")
                                                        <div class="label new">best</div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="product__item__text">
                                                <h6>
                                                    @if($item->name == null)
                                                        Code : {{$item->item_code}}
                                                    @else
                                                        {{$item->name}}
                                                    @endif
                                                </h6>
                                                @if($item->brand_name != null)
                                                    <p>
                                                        {{$item->brand_name}}
                                                    </p>
                                                @endif
                                                @if(isset($item->promotion_id))
                                                    <div class="product__price">
                                                        <span>{{number_format($item->saleprice)}} MMK</span>
                                                    </div>
                                                    <div class="product__price">
                                                        {{ number_format($item->discount_price) }} MMK
                                                    </div>
                                                @else
                                                    <div class="product__price">{{number_format($item->saleprice)}} MMK</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="m-auto">No matches found accroding to your filter!</p>
                        @endif
                        <div class="col-lg-12 text-center">
                            {{ $items->appends($data)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- Mobile Filter Modal Start -->
    <div class="modal fade" tabindex="-1" id="filter_modal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Filter Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" onsubmit="return validateMobileFilterForm()" action="{{route('filter')}}">
                        @if($byMainCate != "")
                            <input type="hidden" id="maincategory_id" name="maincategory_id" value="{{ $byMainCate->id }}">
                        @elseif($bySubCate != "")
                            <input type="hidden" id="subcategory_id" name="subcategory_id" value="{{ $bySubCate->id }}">
                        @elseif($byBrand != "")
                            <input type="hidden" id="brand_id" name="brand_id" value="{{ $byBrand->id }}">
                        @endif
                        <div class="shop__sidebar">
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
                                                                        <label for="MC_{{$category->id}}" class="click">
                                                                            <input type="radio" class="radio" id="MC_{{$category->id}}" name="category" value="{{ $category->id }}"
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
                                    <label for="M_all">
                                        Both
                                        <input type="radio" id="M_all" class="radio" name="product" value="all"
                                        {{ Session::get('product') == 'all' ? 'checked' : '' }} checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="M_instock">
                                        Instock Only
                                        <input type="radio" id="M_instock" class="radio" name="product" value="instock"
                                        {{ Session::get('product') == 'instock' ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for=">M_preorder">
                                        Preorder Only
                                        <input type="radio" id=">M_preorder" class="radio" name="product" value="preorder"
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
                                    <input type="number" class="customized_input_number mb-3" id="M_minprice" name="minprice"
                                    onkeypress="return numbersOnly(event)" placeholder="Minimum" value="{{ Session::get('minprice') }}">
                                    <input type="number" class="customized_input_number mb-3" id="M_maxprice" name="maxprice"
                                    onkeypress="return numbersOnly(event)" placeholder="Maximum" value="{{ Session::get('maxprice') }}">
                                </div>
                            </div>
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Shop by Trends</h4>
                                </div>
                                <div class="size__list">
                                    <label for="M_new_arrival">
                                        New Arrival
                                        <input type="radio" id="M_new_arrival" class="radio" name="trend" value="new"
                                        {{ Session::get('trend') == 'new' ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="M_best_selling">
                                        Best Selling
                                        <input type="radio" id="M_best_selling" class="radio" name="trend" value="best"
                                        {{ Session::get('trend') == 'best' ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="M_promotion">
                                        Promotion
                                        <input type="radio" id="M_promotion" class="laptop_trend radio" name="trend" value="promotion"
                                        {{ Session::get('trend') == 'promotion' ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="filter_btn mr-3 to_filter" value="Filter">
                        <input type="reset" class="filter_btn reset" value="Clear">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Filter Modal End -->
@endsection

@section('javascript')
    <script>
        function getfilter(resp) {
            console.log(resp);
        }

        $('.reset').click(function() {
            $('input[type=radio]').removeAttr('checked');
            $('input[type=number]').removeAttr('value');
        })

        function validateLaptopFilterForm() {
            var Lproduct = $("input[type='radio'][name='product']:checked").val();
            var Lcategory = $("input[type='radio'][name='category']:checked").val();
            var Lminprice = $("input[type='number'][id='minprice']").val();
            var Lmaxprice = $("input[type='number'][id='maxprice']").val();
            var Ltrend = $("input[type='radio'][name='trend']:checked").val();
            var Lpromotion = $("input[type='radio'][name='promotion']:checked").val();
            
            if (Lproduct == null || Lproduct == "") {
                if (Lcategory == null || Lcategory == "") {
                    if (Lminprice == null || Lminprice == "") {
                        if (Lmaxprice == null || Lmaxprice == "") {
                            if (Ltrend == null || Ltrend == "") {
                                if (Lpromotion == null || Lpromotion == "") {
                                    alert("Your Search Data are empty! Please fill search data fields!");
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }

        function validateMobileFilterForm() {
            var Mproduct = $("input[type='radio'][name='product']:checked").val();
            var Mcategory = $("input[type='radio'][name='category']:checked").val();
            var Mminprice = $("input[type='number'][id='M_minprice']").val();
            var Mmaxprice = $("input[type='number'][id='M_maxprice']").val();
            var Mtrend = $("input[type='radio'][name='trend']:checked").val();
            var Mpromotion = $("input[type='radio'][name='promotion']:checked").val();

            if (Mproduct == null || Mproduct == "") {
                if (Mcategory == null || Mcategory == "") {
                    if (Mminprice == null || Mminprice == "") {
                        if (Mmaxprice == null || Mmaxprice == "") {
                            if (Mtrend == null || Mtrend == "") {
                                if (Mpromotion == null || Mpromotion == "") {
                                    alert("Your Search Data are empty! Please fill search data fields!");
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
    </script>
@endsection