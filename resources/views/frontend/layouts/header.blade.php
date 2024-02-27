<!-- header-start -->
<header class="header d-blue-bg">
    <div class="header-top">
        <div class="container">
            <div class="header-inner">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-7">
                        <div class="header-inner-start">
                            <div class="header__currency border-right">
                                <div class="s-name">
                                    <span>Til: </span>
                                </div>
                                <select>
                                    <option>O'zbekcha</option>
                                </select>
                            </div>
                            <div class="header__lang border-right">
                                <div class="s-name">
                                    <span>Valyuta: </span>
                                </div>
                                <select>
                                    <option>UZS</option>
                                </select>
                            </div>
                            <div class="support d-none d-sm-block">
                                <p>Yordam kerakmi? <a href="tel:+998903040007">+998 90 304 0007</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 d-none d-lg-block">
                        <div class="header-inner-end text-md-end">
                            <div class="ovic-menu-wrapper">
                                <ul>
                                    <li><a href="{{route('order.track')}}">Buyurtmani kuzatish</a></li>
                                    <li><a href="{{route('contact')}}">Biz bilan bog'lanish</a></li>
                                    <li><a href="#">Tez-tez so'raladigan savollar</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mid">
        <div class="container">
            <div class="heade-mid-inner">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                        <div class="header__info">
                            <div class="logo">
                                <a href="{{route('home')}}" class="logo-image">
                                    <img src="{{asset('/front/img/oq.png')}}"alt="logo">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                        <div class="header__search">
                            <form method="POST" action="{{route('product.search')}}">
                                <div class="header__search-box">
                                    <input class="search-input" type="text" placeholder="Maxsulot izlash...">
                                    <button class="button" type="submit"><i class="far fa-search"></i></button>
                                </div>
                                <div class="header__search-cat">
                                    <select>
                                        <option>Barcha Kategoriyalar</option>
                                        @foreach(Helper::getAllCategory() as $cat)
                                        <option>{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-8 col-sm-8">
                        <div class="header-action">
                            <div class="block-userlink">
                                @auth
                                @if(Auth::user()->role=='admin')
                                <a class="icon-link" href="{{route('admin')}}" target="_blank">
                                    @else
                                    <a class="icon-link" href="{{route('user')}}" target="_blank">
                                        @endif
                                        <i class="flaticon-user"></i>
                                        <span class="text">
                                            <span class="sub">{{Auth()->user()->name}} </span>
                                            </span>
                                    </a>
                                    @else
                                    <a class="icon-link icon-link-2" href="{{route('login.form')}}">
                                        <i class="flaticon-user"></i>
                                        <span class="text">
                                            <span class="sub">Login </span>
                                            Mening hisobim </span>
                                    </a>
                                    @endauth
                            </div>
                            <div class="block-wishlist action">
                                @php
                                $total_prod=0;
                                $total_amount=0;
                                @endphp
                                @if(session('wishlist'))
                                @foreach(session('wishlist') as $wishlist_items)
                                @php
                                $total_prod+=$wishlist_items['quantity'];
                                $total_amount+=$wishlist_items['amount'];
                                @endphp
                                @endforeach
                                @endif
                                <a class="icon-link" href="{{route('wishlist')}}">
                                    <i class="flaticon-heart"></i>
                                    <span class="count">{{Helper::wishlistCount()}}</span>
                                    <span class="text">
                                        <span class="sub">Saralangan</span>
                                        Maxsulotlar </span>
                                </a>
                            </div>
                            <div class="block-cart action">
                                <a class="icon-link" href="cart.html">
                                    <i class="flaticon-shopping-bag"></i>
                                    <span class="count">{{Helper::cartCount()}}</span>
                                    <span class="text">
                                        <span class="sub">Savat</span>
                                         </span>
                                </a>
                                @auth
                                <div class="cart">
                                    <div class="cart__mini">
                                        <ul>
                                            <li>
                                                <div class="cart__title">
                                                    <h4>Savat</h4>
                                                    <span>{{count(Helper::getAllProductFromCart())}} Maxsulot</span>
                                                </div>
                                            </li>
                                            <li>
                                            {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach(Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                                <div class="cart__item d-flex justify-content-between align-items-center">
                                                    <div class="cart__inner d-flex">
                                                        <div class="cart__thumb">
                                                            <a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">
                                                                <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                                            </a>
                                                        </div>
                                                        <div class="cart__details">
                                                            <h6><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank"> {{$data->product['title']}} </a></h6>
                                                            <div class="cart__price">
                                                                {{$data->quantity}} x - <span>{{number_format($data->price,2)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart__del">
                                                        <a href="{{route('cart-delete',$data->id)}}"><i class="fal fa-times"></i></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </li>
                                            <li>
                                                <div
                                                    class="cart__sub d-flex justify-content-between align-items-center">
                                                    <h6>Umumiy summa</h6>
                                                    <span class="cart__sub-total">UZS {{number_format(Helper::totalCartPrice(),2)}}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="{{route('cart')}}" class="wc-cart mb-10">Savatni ko'rish</a>
                                                <a href="{{route('checkout')}}" class="wc-checkout">Rasmiylashtirish</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <div class="row g-0 align-items-center">
                <div class="col-lg-3">                        
                    <div class="cat__menu-wrapper side-border d-none d-lg-block">
                        <div class="cat-toggle">
                            <button type="button" class="cat-toggle-btn cat-toggle-btn-1"><i class="fal fa-bars"></i> Barcha kategoriyalar</button>
                            <div class="cat__menu">
                                <nav id="mobile-menu" style="display: block;">
                                    <ul>
                                        {{Helper::getHeaderCategory()}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-3">
                    <div class="header__bottom-left d-flex d-xl-block align-items-center">
                        <div class="side-menu d-lg-none mr-20">
                            <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i
                                    class="fas fa-bars"></i></button>
                        </div>
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="{{route('home')}}" class="{{Request::path()=='home' ? 'active' : ''}}">Bosh sahifa</a>
                                    </li>
                                    <li><a href="{{route('about-us')}}" class="{{Request::path()=='about-us' ? 'active' : ''}}">Biz haqimizda</a></li>
                                    <li><a href="{{route('product-grids')}}" class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif">
                                        Maxsulotlar</a>
                                       
                                    </li>
                                    <li><a href="{{route('blog')}}" class="{{Request::path()=='blog' ? 'active' : ''}}">Blog</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-9">
                    <div class="shopeing-text text-sm-end">
                        <p>Darkor Dekor milliylikni sevganlar uchun</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->