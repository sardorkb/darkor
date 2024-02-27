@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection
@section('title',' Maxsulot | Darkor Dekor')
@section('main-content')

<!-- breadcrumb__area-start -->
<section class="breadcrumb__area box-plr-75">
	<div class="container">
		<div class="row">
			<div class="col-xxl-12">
				<div class="breadcrumb__wrapper">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{$product_detail->title}}</li>
						</ol>
						</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- breadcrumb__area-end -->
	<!-- product-details-start -->
	<div class="product-details">
	<div class="container">
		<div class="row">
			<div class="col-xl-6">
				<div class="product__details-nav d-sm-flex align-items-start">
					<div class="product__details-thumb">
						<div class="tab-content" id="productThumbContent">
								<div class="tab-pane fade show active" id="thumbOne" role="tabpanel" aria-labelledby="thumbOne-tab">
									@php 
										$photo=explode(',',$product_detail->photo);
										// dd($photo);
									@endphp
									@foreach($photo as $data)
									<div class="product__details-nav-thumb w-img" data-thumb="{{$data}}">
										<img src="{{$data}}" alt="{{$data}}">
									</div>
									@endforeach
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="product__details-content">
					<h6>{{$product_detail->title}}</h6>
					<div class="pd-rating mb-10">
						<ul class="rating">
							@php
								$rate=ceil($product_detail->getReview->avg('rate'))
							@endphp
								@for($i=1; $i<=5; $i++)
									@if($rate>=$i)
										<li><i class="fa fa-star"></i></li>
									@else 
										<li><i class="fa fa-star-o"></i></li>
									@endif
								@endfor
						</ul>
						<span>({{$product_detail['getReview']->count()}})</span>
					</div>
					<div class="price mb-10">
						@php 
							$after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
						@endphp
						<span>UZS {{number_format($after_discount,2)}}</span><s>UZS {{number_format($product_detail->price,2)}}</s></span>
					</div>
					<div class="features-des mb-20 mt-10">
						<p>{!!($product_detail->summary)!!}</p>
					</div>
					<div class="product-stock mb-20">
						@if($product_detail->stock>0)
						<h5>Mavjud: <span> {{$product_detail->stock}}</span></h5>
						@else 
						<h5>Mavjud emas: <span> {{$product_detail->stock}}ta maxsulot</span></h5>
						@endif
					</div>
					<form action="{{route('single-add-to-cart')}}" method="POST">
						@csrf
						<div class="cart-option mb-15">
							<div class="product-quantity mr-20">
								<div class="cart-plus-minus p-relative"><input type="text" value="1"><div class="dec qtybutton">-</div><div class="inc qtybutton">+</div></div>
							</div>
							<input type="hidden" name="slug" value="{{$product_detail->slug}}">
							<button class="cart-btn" type="submit">Savatga qo'shish</button>
						</div>
						<div class="details-meta">
							<div class="d-meta-left">
								<div class="dm-item mr-20">
									<a href="{{route('add-to-wishlist',$product_detail->slug)}}"><i class="fal fa-heart"></i>Saralanganga olish</a>
								</div>
						</div>
					</form>
					<div class="product-tag-area mt-15">
						<div class="product_info">
							<span class="posted_in">
								<span class="title">Kategoriya:</span>
								<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a>
								@if($product_detail->sub_cat_info)
								<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a>
								@endif
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- product-details-end -->

<!-- product-details-des-start -->
<div class="product-details-des mt-40 mb-60">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="product__details-des-tab">
					<ul class="nav nav-tabs" id="productDesTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button" role="tab" aria-controls="des" aria-selected="true">Maxsulot haqida </button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="aditional-tab" data-bs-toggle="tab" data-bs-target="#aditional" type="button" role="tab" aria-controls="aditional" aria-selected="false">Qo'shimcha ma'lumotlar</button>
							</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Baholar (1) </button>
						</li>
						</ul>
				</div>
			</div>
		</div>
		<div class="tab-content" id="prodductDesTaContent">
			<div class="tab-pane fade active show" id="des" role="tabpanel" aria-labelledby="des-tab">
				<div class="product__details-des-wrapper">
					<p class="des-text mb-35">{!! ($product_detail->description) !!}</p>
				</div>
			</div>
			<div class="tab-pane fade" id="aditional" role="tabpanel" aria-labelledby="aditional-tab">
				<div class="product__desc-info">
					<ul>
						<li>
							<h6>Razmeri</h6>
							<span>{{$product_detail->size}}</span>
						</li>
						<li>
							<h6>Holati</h6>
							<span>{{$product_detail->condition}}</span>
						</li>
						<li>
							<h6>Necha foiz aksiya</h6>
							<span>{{$product_detail->discount}}%</span>
						</li>
						<li>
							<h6>Mavjudligi</h6>
							<span>{{$product_detail->stock}} dona</span>
						</li>
						
					</ul>
					</div>
			</div>
			<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
				<div class="product__details-review">
					<div class="row">
						<div class="col-xl-4">
							<div class="review-rate">
								<h5>5.00</h5>
								<div class="review-star">
									<a href="#"><i class="fas fa-star"></i></a>
									<a href="#"><i class="fas fa-star"></i></a>
									<a href="#"><i class="fas fa-star"></i></a>
									<a href="#"><i class="fas fa-star"></i></a>
									<a href="#"><i class="fas fa-star"></i></a>
								</div>
								<span class="review-count">01 Review</span>
							</div>
						</div>
						<div class="col-xl-8">
							<div class="review-des-infod">
								<h6>1 review for "<span>Wireless Bluetooth Over-Ear Headphones</span>"</h6>
								<div class="review-details-des">
									<div class="author-image mr-15">
										<a href="#"><img src="assets/img/author/author-sm-1.jpeg" alt=""></a>
									</div>
									<div class="review-details-content">
										<div class="str-info">
											<div class="review-star mr-15">
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
												<a href="#"><i class="fas fa-star"></i></a>
											</div>
											<div class="add-review-option">
												<a href="#">Add Review</a>
											</div>
										</div>
										<div class="name-date mb-30">
											<h6> admin – <span> May 27, 2021</span></h6>
										</div>
										<p>A light chair, easy to move around the dining table and about the room. Duis aute irure dolor in reprehenderit in <br> voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-12">
							<div class="product__details-comment ">
								<div class="comment-title mb-20">
									<h3>Add a review</h3>
									<p>Your email address will not be published. Required fields are marked *</p>
								</div>
								<div class="comment-rating mb-20">
									<span>Overall ratings</span>
									<ul>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
										<li><a href="#"><i class="fas fa-star"></i></a></li>
									</ul>
								</div>
								<div class="comment-input-box">
									<form action="#">
										<div class="row">
										<div class="col-xxl-6 col-xl-6">
											<div class="comment-input">
												<input type="text" placeholder="Your Name">
											</div>
											</div>
											<div class="col-xxl-6 col-xl-6">
											<div class="comment-input">
												<input type="email" placeholder="Your Email">
											</div>
											</div>
											<div class="col-xxl-12">
												<textarea placeholder="Your review" class="comment-input comment-textarea"></textarea>
											</div>
											<div class="col-xxl-12">
											<div class="comment-agree d-flex align-items-center mb-25">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
													<label class="form-check-label" for="flexCheckDefault">
													Save my name, email, and website in this browser for the next time I comment.
													</label>
												</div>
											</div>
											</div>
											<div class="col-xxl-12">
											<div class="comment-submit">
												<button type="submit" class="cart-btn">Submit</button>
											</div>
											</div>
										</div>
									</form>
								</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- product-details-des-end -->

@endsection
@push('styles')
	<style>
		/* Rating */
		.rating_box {
		display: inline-flex;
		}

		.star-rating {
		font-size: 0;
		padding-left: 10px;
		padding-right: 10px;
		}

		.star-rating__wrap {
		display: inline-block;
		font-size: 1rem;
		}

		.star-rating__wrap:after {
		content: "";
		display: table;
		clear: both;
		}

		.star-rating__ico {
		float: right;
		padding-left: 2px;
		cursor: pointer;
		color: #F7941D;
		font-size: 16px;
		margin-top: 5px;
		}

		.star-rating__ico:last-child {
		padding-left: 0;
		}

		.star-rating__input {
		display: none;
		}

		.star-rating__ico:hover:before,
		.star-rating__ico:hover ~ .star-rating__ico:before,
		.star-rating__input:checked ~ .star-rating__ico:before {
		content: "\F005";
		}

	</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}

@endpush