@extends('frontend.layouts.master')

@section('title','Darkor Dekor | Maxsulotlar')

@section('main-content')
<!-- breadcrumb__area-start -->
<section class="breadcrumb__area box-plr-75">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Bosh sahifa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Maxsulotlar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcrumbs -->

<!-- Product Style -->
<form action="{{route('shop.filter')}}" method="POST">
    @csrf
    <div class="shop-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <!-- Single Widget -->
                    <div class="product-widget mb-30">
                        <h5 class="pt-title">Kategoriyalar</h5>
                        <div class="widget-category-list mt-20">
                            @php
                            // $category = new Category();
                            $menu=App\Models\Category::getAllParentWithChild();
                            @endphp
                            @if($menu)
                            <li>
                                @foreach($menu as $cat_info)
                                @if($cat_info->child_cat->count()>0)
                            <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
                                <ul>
                                    @foreach($cat_info->child_cat as $sub_menu)
                                    <li><a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">{{$sub_menu->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li><a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
                            @endif
                            @endforeach
                            </li>
                            @endif
                            {{-- @foreach(Helper::productCategoryList('products') as $cat)
                                            @if($cat->is_parent==1)
												<li><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></li>
                            @endif
                            @endforeach --}}
                        </div>
                    </div>
                    <!--/ End Single Widget -->
                    <!-- Single Widget -->
                    <div class="product-widget mb-30">
                        <h5 class="pt-title">Brendlar</h5>
                        <div class="widget-category-list mt-20">
                            <div class="single-widget-category">
                                @php
                                $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                @endphp
                                @foreach($brands as $brand)
                                <li><a href="{{route('product-brand',$brand->slug)}}">{{$brand->title}}</a></li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--/ End Single Widget -->
                    <!-- Single Widget -->
                    <div class="product-widget mb-30">
                        <h5 class="pt-title">Eng so'nggi maxsulotlar</h5>
                        {{-- {{dd($recent_products)}} --}}
                        @foreach($recent_products as $product)
                        <!-- Single Post -->
                        @php
                        $photo=explode(',',$product->photo);
                        @endphp
                        <div class="product__sm mt-20">
                            <ul>
                                <li class="product__sm-item d-flex align-items-center">
                                    <div class="product__sm-thumb mr-20">
                                        <a href="{{route('product-detail',$product->slug)}}">
                                            <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        </a>
                                    </div>
                                    <div class="product__sm-content">
                                        <h5 class="product__sm-title">
                                            <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                        </h5>
                                        {!! html_entity_decode($product->summary) !!}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Single Post -->
                        @endforeach
                    </div>
                    <!--/ End Single Widget -->

                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="product-lists-top">
                        <div class="product__filter-wrap">
                            <div class="row align-items-center">
                                <!-- Shop Top -->
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="product__filter d-sm-flex align-items-center">
                                        <div class="product__col">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="FourCol-tab" data-bs-toggle="tab" data-bs-target="#FourCol" type="button" role="tab" aria-controls="FourCol" aria-selected="true">
                                                        <i class="fal fa-th"></i>
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="FiveCol-tab" data-bs-toggle="tab" data-bs-target="#FiveCol" type="button" role="tab" aria-controls="FiveCol" aria-selected="false">
                                                        <i class="fal fa-list"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__result pl-60">
                                            <p>Showing 1-20 of 29 relults</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="product__filter-right d-flex align-items-center justify-content-md-end">
                                        <div class="product__sorting product__show-no">
                                            <select class="show" name="show" onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9' ) selected @endif>09</option>
                                                <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15' ) selected @endif>15</option>
                                                <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21' ) selected @endif>21</option>
                                                <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30' ) selected @endif>30</option>
                                            </select>
                                        </div>
                                        <div class="product__sorting product__show-position ml-20">
                                            <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                <option value="">Default</option>
                                                <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title' ) selected @endif>Name</option>
                                                <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category' ) selected @endif>Category</option>
                                                <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand' ) selected @endif>Brand</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    <div class="tab-content" id="productGridTabContent">
                        {{-- {{$products}} --}}

                        <div class="tab-pane fade  show active" id="FourCol" role="tabpanel" aria-labelledby="FourCol-tab">
                            <div class="tp-wrapper">
                                <div class="row g-0">
                                    @if(count($products)>0)
                                    @foreach($products as $product)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item product__item-d">
                                            <div class="product__thumb fix">
                                                <div class="product-image w-img">
                                                    <a href="{{route('product-detail',$product->slug)}}">
                                                        @php
                                                        $photo=explode(',',$product->photo);
                                                        @endphp
                                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                    </a>
                                                    <div class="product-action">
                                                        <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" class="wishlist" data-id="{{$product->id}}">
                                                            <i class="fal fa-heart"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="product__content-3">
                                                    <h6><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h6>
                                                </div>
                                                <div class="product__add-cart-s text-center">
                                                    <a type="button" class="cart-btn d-flex mb-10 align-items-center justify-content-center w-100" href="{{route('add-to-cart',$product->slug)}}">
                                                        Savatga qo'shish
                                                    </a>
                                                    <a type="button" class="wc-checkout d-flex align-items-center justify-content-center w-100" data-bs-toggle="modal" data-bs-target="#{{$product->id}}">
                                                        Tez ko'rish
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 justify-content-center d-flex">
                            {{$products->appends($_GET)->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!--/ End Product Style 1  -->



@endsection
@push('styles')
<style>
    .pagination {
        display: inline-flex;
    }

    .filter_button {
        /* height:20px; */
        text-align: center;
        background: #F7941D;
        padding: 8px 16px;
        margin-top: 10px;
        color: white;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt($("#slider-range").data('max')) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value + '-' + max_value;
            if ($("#price_range").length > 0 && $("#price_range").val()) {
                price_range = $("#price_range").val().trim();
            }

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function(event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  " + currency + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  " + m_currency + $("#slider-range").slider("values", 1));
        }
    })
</script>
@endpush