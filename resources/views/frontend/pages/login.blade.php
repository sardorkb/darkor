@extends('frontend.layouts.master')

@section('title','Darkor Dekor | Login & Royxatdan otish')

@section('main-content')
       <!-- page-banner-area-start -->
       <div class="page-banner-area page-banner-height-2" data-background="assets/img/banner/page-banner-4.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-banner-content text-center">
                        <h4 class="breadcrumb-title">Mening xisobim</h4>
                        <div class="breadcrumb-two">
                            <nav>
                               <nav class="breadcrumb-trail breadcrumbs">
                                  <ul class="breadcrumb-menu">
                                     <li class="breadcrumb-trail">
                                        <a href="{{route('home')}}"><span>Bosh sahifa</span></a>
                                     </li>
                                     <li class="trail-item">
                                        <span>Mening xisobim</span>
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
            
   <!-- account-area-start -->
   <div class="account-area mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="basic-login mb-50">
                        <h5>Login</h5>
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('login.submit')}}">
                            @csrf
                            <label for="name">Elektron pochta <span>*</span></label>
                            <input id="name" type="email" name="email" placeholder="E-pochtangizni kiriting">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <label for="pass">Parol <span>*</span></label>
                            <input type="password" name="password" placeholder="Parolni kiriting..." value="{{old('password')}}" required="required">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="login-action mb-10 fix">
                                <span class="log-rem f-left">
                                   <input id="remember" type="checkbox">
                                   <label for="remember">Eslab qol</label>
                                </span>
                                @if (Route::has('password.request'))
                                <span class="forgot-login f-right">
                                   <a href="#">Parolni esingizdan chiqardingizmi?</a>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="tp-in-btn w-100">Kirish</button>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="basic-login">
                    <h5>Ro'yxatdan o'tish</h5>
                    <form class="form" method="post" action="{{route('register.submit')}}">
                        @csrf
                        <label for="username">F.I.SH <span>*</span></label>
                        <input name="name" type="text" placeholder="F.I.SH. ni kiriting..." value="{{old('name')}}" required="required">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label for="email-id">Elektron Pochta <span>*</span></label>
                        <input type="text" name="email" placeholder="Elektron pochtani kiriting..." required="required" value="{{old('email')}}">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label for="userpass">Parol <span>*</span></label>
                        <input type="password" name="password" placeholder="Parolni kiriting..." required="required" value="{{old('password')}}">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label for="userpass">Parolni tasdiqlang <span>*</span></label>
                        <input type="password" name="password_confirmation" placeholder="Parolni qayta kiriting..." required="required" value="{{old('password_confirmation')}}">
                        <div class="login-action mb-10 fix">
                            <p>Sizning shaxsiy ma'lumotlaringiz ushbu veb-saytdagi tajribangizni qo'llab-quvvatlash, hisobingizga kirishni boshqarish va bizning maqolamizda tasvirlangan boshqa maqsadlarda foydalaniladi. <a href="#">Qonun qoidalar</a>.</p>
                        </div>
                        <button class="tp-in-btn w-100" type="submit">Ro'yxatdan o'tish</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection