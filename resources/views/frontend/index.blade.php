@extends('frontend.layouts.master')
@section('title','Darkor Dekor | Bino uchun kerakligi bor')
@section('main-content')
<!-- slider-area-start -->
@if(count($banners)>0)
<div class="slider-area">
    @foreach($banners as $key=>$banner)
    <div class="swiper-container {{(($key==0)? 'active' : '')}}">
        @endforeach
        <div class="slider-wrapper swiper-wrapper">
            @foreach($banners as $key=>$banner)
            <div class="single-slider swiper-slide slider-height d-flex align-items-center" data-background="{{$banner->photo}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="slider-content">
                                <h2 data-animation="fadeInLeft" data-delay="1.7s" class="pt-15 slider-title pb-5"> {{$banner->title}}
                                </h2>
                                <p class="pr-20 slider_text" data-animation="fadeInLeft" data-delay="1.9s">{!! html_entity_decode($banner->description) !!}</p>
                                <div class="slider-bottom-btn mt-75">
                                    <a data-animation="fadeInUp" data-delay="1.15s" href="{{route('product-grids')}}" class="st-btn-b b-radius">Xoziroq sotib oling</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- /single-slider -->
            <div class="main-slider-paginations"></div>
        </div>
    </div>
</div>
@endif
<!-- slider-area-end -->
<!-- features__area-start -->
<section class="features__area pt-20">
    <div class="container">
        <div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1 gx-0">
            <div class="col">
                <div class="features__item d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fal fa-truck"></i>
                    </div>
                    <div class="features__content">
                        <h6>FREE DELIVERY</h6>
                        <p>For all orders over $120</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="features__item d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fal fa-money-check"></i>
                    </div>
                    <div class="features__content">
                        <h6>SAFE PAYMENT</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="features__item d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fal fa-comments-alt"></i>
                    </div>
                    <div class="features__content">
                        <h6>24/7 HELP CENTER</h6>
                        <p>Delicated 24/7 support</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="features__item features__item-last d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fad fa-user-headset"></i>
                    </div>
                    <div class="features__content">
                        <h6>FRIENDLY SERVICES</h6>
                        <p>30 day satisfaction guarantee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- features__area-end -->
<!-- banner__area-start -->
<section class="banner__area pt-20 pb-10">
    <div class="container">
        <div class="row">
            @php
            $category_lists=DB::table('categories')->where('status','active')->limit(3)->get();
            @endphp
            @if($category_lists)
            @foreach($category_lists as $cat)
            @if($cat->is_parent==1)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="banner__item p-relative w-img mb-30">
                    @if($cat->photo)
                    <div class="banner__img">
                        <a href="{{route('product-cat',$cat->slug)}}"><img src="{{$cat->photo}}" alt=""></a>
                    </div>
                    @else
                    <div class="banner__img">
                        <a href="{{route('product-cat',$cat->slug)}}"><img src="assets/img/banner/banner-1.jpg" alt=""></a>
                    </div>
                    @endif
                    <div class="banner__content">
                        <h6><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></h6>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
    </div>
</section>
<!-- banner__area-end -->
{{-- @php
    $featured=DB::table('products')->where('is_featured',1)->where('status','active')->orderBy('id','DESC')->limit(1)->get();
@endphp --}}
<!-- topsell__area-start -->
<section class="topsell__area-2 pt-15">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-10">
                    <div class="section__title">
                        <h5 class="st-titile">Trenddagi maxsulotlar</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="tab-content" id="flast-sell-tabContent">
                    <div class="tab-pane fade active show" id="computer" role="tabpanel" aria-labelledby="computer-tab">
                        <div class="product-bs-slider-2">
                            <div class="product-slider-2 swiper-container">
                                <div class="swiper-wrapper">
                                    @if($product_lists)
                                    @foreach($product_lists as $key=>$product)
                                    <div class="product__item swiper-slide">
                                        <div class="product__thumb fix">
                                            @php
                                            $photo=explode(',',$product->photo);
                                            // dd($photo);
                                            @endphp
                                            <div class="product-image w-img">
                                                <a href="{{route('product-detail',$product->slug)}}">
                                                    <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                </a>
                                            </div>
                                            @if($product->stock<=0)<span class="out-of-stock">Sale out</span>
                                                @else($product->condition=='new')
                                                <div class="product__offer">
                                                    <span class="discount">-{{$product->discount}}%</span>
                                                </div>
                                                @endif
                                                <div class="product-action">
                                                    <a href="{{route('product-detail',$product->slug)}}" class="icon-box icon-box-1" data-bs-toggle="modal" data-bs-target="#{{$product->id}}">
                                                        <i class="fal fa-eye"></i>
                                                        <i class="fal fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('add-to-wishlist',$product->slug)}}" class="icon-box icon-box-1">
                                                        <i class="fal fa-heart"></i>
                                                        <i class="fal fa-heart"></i>
                                                    </a>
                                                </div>
                                        </div>
                                        <div class="product__content">
                                            <h6><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h6>
                                            @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                            @endphp
                                            <div class="price">
                                                <span>{{number_format($after_discount,2)}}/{{number_format($product->price,2)}}</span>
                                            </div>
                                        </div>
                                        <div class="product__add-cart text-center">
                                            <a href="{{route('add-to-cart',$product->slug)}}" class="cart-btn product-modal-sidebar-open-btn d-flex align-items-center justify-content-center w-100">Add to Cart</a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="bs-button bs2-button-prev"><i class="fal fa-chevron-left"></i></div>
                            <div class="bs-button bs2-button-next"><i class="fal fa-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- topsell__area-end -->

<!-- moveing-text-area-start -->
<section class="moveing-text-area">
    <div class="container">
        <div class="ovic-running">
            <div class="wrap">
                <div class="inner">
                    <p class="item">Free UK Delivery - Return Over $100.00 ( Excluding Homeware ) | Free UK Collect From Store</p>
                    <p class="item">Design Week / 15% Off the website / Code: AYOSALE-2020</p>
                    <p class="item">Always iconic. Now organic. Introducing the $20 Organic Tee.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- moveing-text-area-end -->
<!-- recomand-product-area-start -->
<section class="recomand-product-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-10">
                    <div class="section__title">
                        <h5 class="st-titile">Eng so'nggi maxsulotlar</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="product-bs-slider-2">
                <div class="product-slider-3 swiper-container">
                    <div class="swiper-wrapper">
                        <div class="product__item mb-20 swiper-slide">
                            @php
                            $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(3)->get();
                            @endphp
                            @foreach($product_lists as $product)
                            <div class="product__thumb fix">

                                <div class="product-image w-img">
                                    @php
                                    $photo=explode(',',$product->photo);
                                    // dd($photo);
                                    @endphp
                                    <a href="{{route('add-to-cart',$product->slug)}}">
                                        <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    </a>
                                </div>
                                <div class="product__offer">
                                    <span class="discount">-{{number_format($product->discount,2)}}%</span>
                                </div>
                                <div class="product-action">
                                    <a href="#" class="icon-box icon-box-1" data-bs-toggle="modal" data-bs-target="#productModalId">
                                        <i class="fal fa-eye"></i>
                                        <i class="fal fa-eye"></i>
                                    </a>
                                    <a href="#" class="icon-box icon-box-1">
                                        <i class="fal fa-heart"></i>
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product__content">
                                <h6><a href="{{route('add-to-cart',$product->slug)}}">{{$product->title}}</a></h6>
                                <div class="rating mb-5">
                                    <ul>
                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                        <li><a href="#"><i class="fal fa-star"></i></a></li>
                                    </ul>
                                    <span>(01 review)</span>
                                </div>
                                <div class="price">
                                    <span>UZS {{number_format($product->price,2)}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- recomand-product-area-end -->

<!-- blog-area-start -->
<div class="blog-area pt-55 pb-75">
    <div class="container 0">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-30">
                    <div class="section__title section__title-2">
                        <h5 class="st-titile">Songgi blog yangiliklar </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
            @foreach($posts as $post)
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4">
                <div class="single-smblog mb-30">
                    <div class="smblog-thum">
                        <div class="blog-image blog-image-2 w-img">
                            <a href="{{route('blog.detail',$post->slug)}}"><img src="{{$post->photo}}" alt="{{$post->photo}}"></a>
                        </div>
                    </div>
                    <div class="smblog-content smblog-content-2">
                        <h6><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h6>
                        <div class="smblog-foot pt-15">
                            <div class="post-readmore">
                                <a href="{{route('blog.detail',$post->slug)}}"> Oqishda davom eting<span class="icon"></span></a>
                            </div>
                            <div class="post-date">
                                <a href="{{route('blog.detail',$post->slug)}}">{{$post->created_at->format('d M , Y. D')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<!-- blog-area-end -->

@include('frontend.layouts.newsletter')
@endsection