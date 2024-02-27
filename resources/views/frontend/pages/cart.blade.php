@extends('frontend.layouts.master')
@section('title', 'Savat | Darkor Dekor')
@section('main-content')
    <!-- page-banner-area-start -->
    <div class="page-banner-area page-banner-height-2" data-background="assets/img/banner/page-banner-4.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-banner-content text-center">
                        <h4 class="breadcrumb-title">Sizning savatingiz</h4>
                        <div class="breadcrumb-two">
                            <nav>
                                <nav class="breadcrumb-trail breadcrumbs">
                                    <ul class="breadcrumb-menu">
                                        <li class="breadcrumb-trail">
                                            <a href="{{ 'home' }}"><span>Bosh sahifa</span></a>
                                        </li>
                                        <li class="trail-item">
                                            <span>Savat</span>
                                        </li>
                                    </ul>
                                </nav>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-area-end -->
    <!-- End Breadcrumbs -->

    <!-- cart-area-start -->
    <section class="cart-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Rasm</th>
                                    <th class="cart-product-name">Maxsulot nomi</th>
                                    <th class="product-quantity">Miqdori</th>
                                    <th class="product-remove">O'chirish</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    @if (Helper::getAllProductFromCart())
                                        @foreach (Helper::getAllProductFromCart() as $key => $cart)
                                            <tr>
                                                @php
                                                    $photo = explode(',', $cart->product['photo']);
                                                @endphp
                                                <td class="product-thumbnail"><a
                                                        href="{{ route('product-detail', $cart->product['slug']) }}"><img
                                                            src="{{ $photo[0] }}" alt="{{ $photo[0] }}"></a></td>
                                                <td class="product-name"><a
                                                        href="{{ route('product-detail', $cart->product['slug']) }}">{{ $cart->product['title'] }}</a>
                                                </td>
                                                <td class="product-quantity" data-title="Qty">
                                                    <div class="cart-plus-minus"><input type="text" name="qty_id[]"
                                                            value="{{ $cart->id }}">
                                                        <div class="dec qtybutton" data-field="quant[{{ $key }}]">-
                                                        </div>
                                                        <div class="inc qtybutton" data-field="quant[{{ $key }}]">+
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-remove"><a
                                                        href="{{ route('cart-delete', $cart->id) }}"><i
                                                            class="fa fa-times"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center">
                                                There are no any carts available. <a href="{{ route('product-grids') }}"
                                                    style="color:blue;">Continue shopping</a>

                                            </td>
                                        </tr>
                                    @endif
                                </form>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <form action="{{ route('coupon-store') }}" method="POST">
                                    @csrf
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="code" value=""
                                            placeholder="Kupon kodini kiriting" type="text">
                                        <button class="tp-btn-h1" name="apply_coupon" type="submit">Kupon qo'shish</button>
                                    </div>
                                    <div class="coupon2">
                                        <button class="tp-btn-h1" name="update_cart" type="submit">Savatni
                                            yangilash</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="cart-page-total">
								<h2>Cart totals</h2>
                                       <ul class="mb-20">
                                          <li>Subtotal <span>$250.00</span></li>
                                          <li>Total <span>$250.00</span></li>
                                       </ul>
                                <a class="tp-btn-h1" href="{{ route('checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
	</section>
	<!-- cart-area-end -->

        <!-- Start Shop Newsletter  -->
        @include('frontend.layouts.newsletter')
        <!-- End Shop Newsletter -->

    @endsection
    @push('styles')
        <style>
            li.shipping {
                display: inline-flex;
                width: 100%;
                font-size: 14px;
            }

            li.shipping .input-group-icon {
                width: 100%;
                margin-left: 10px;
            }

            .input-group-icon .icon {
                position: absolute;
                left: 20px;
                top: 0;
                line-height: 40px;
                z-index: 3;
            }

            .form-select {
                height: 30px;
                width: 100%;
            }

            .form-select .nice-select {
                border: none;
                border-radius: 0px;
                height: 40px;
                background: #f6f6f6 !important;
                padding-left: 45px;
                padding-right: 40px;
                width: 100%;
            }

            .list li {
                margin-bottom: 0 !important;
            }

            .list li:hover {
                background: #F7941D !important;
                color: white !important;
            }

            .form-select .nice-select::after {
                top: 14px;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("select.select2").select2();
            });
            $('select.nice-select').niceSelect();
        </script>
        <script>
            $(document).ready(function() {
                $('.shipping select[name=shipping]').change(function() {
                    let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                    let subtotal = parseFloat($('.order_subtotal').data('price'));
                    let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                    // alert(coupon);
                    $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
                });

            });
        </script>
    @endpush
