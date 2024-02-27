@extends('frontend.layouts.master')

@section('title','Darkor Dekor | Bloglar')

@section('main-content')
  <!-- page-banner-area-start -->
  <div class="page-banner-area page-banner-height-2" data-background="assets/img/banner/page-banner-4.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-banner-content text-center">
                    <h4 class="breadcrumb-title">Blog</h4>
                    <div class="breadcrumb-two">
                        <nav>
                           <nav class="breadcrumb-trail breadcrumbs">
                              <ul class="breadcrumb-menu">
                                 <li class="breadcrumb-trail">
                                    <a href="{{route('home')}}"><span>Bosh sahifa</span></a>
                                 </li>
                                 <li class="trail-item">
                                    <span>Blog</span>
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

<!-- news-detalis-area-start -->
<div class="blog-area mt-120 mb-75">
    <div class="container">
       <div class="row">
          <div class="col-xl-8 col-lg-7">
            <div class="row">
                @foreach($posts as $post)
                {{-- {{$post}} --}}
                <div class="col-xl-6">
                    <div class="single-smblog mb-30">
                        <div class="smblog-thum">
                            <div class="blog-image w-img">
                                <a href="{{route('blog.detail',$post->slug)}}"><img src="{{$post->photo}}" alt="{{$post->photo}}"></a>
                            </div>
                        </div>
                        <div class="smblog-content smblog-content-3">
                            <h6><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h6>
                            <span class="author mb-10">Muallif: <a href="#"> {{$post->author_info->name ?? 'Anonymous'}}</a></span>
                            <p>{!! html_entity_decode($post->summary) !!}</p>
                            <div class="smblog-foot pt-15">
                                <div class="post-readmore">
                                    <a href="{{route('blog.detail',$post->slug)}}"> Batafsil... <span class="icon"></span></a>
                                </div>
                                <div class="post-date">
                                    <a href="{{route('blog.detail',$post->slug)}}">{{$post->created_at->format('d M, Y. D')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="basic-pagination text-center pt-30 pb-30">
                        <nav>
                           <ul>
                              <li>
                                {{-- {{$posts->appends($_GET)->links()}} --}}
                              </li>
                           </ul>
                         </nav>
                     </div>
                </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5">
             <div class="news-sidebar pl-10">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="widget">
                            <form class="form" method="GET" action="{{route('blog.search')}}">
                                <h6 class="sidebar-title"> Blog izlash</h6>
                                <div class="n-sidebar-search">
                                    <input type="text" placeholder="Izlash..." name="search">
                                    <a><button class="button" type="sumbit"><i class="fa fa-search"></i></button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="widget">
                         <h6 class="sidebar-title">Eng so'nggi postlar</h6>
                         <div class="n-sidebar-feed">
                            @foreach($recent_posts as $post)
                               <ul>
                                  <li>
                                     <div class="feed-number">
                                           <a href="{{route('blog.detail',$post->slug)}}"><img src="{{$post->photo}}" alt="{{$post->photo}}"></a>
                                     </div>
                                     <div class="feed-content">
                                           <h6><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h6>
                                           <span class="feed-date">
                                              <i class="fal fa-calendar-alt"></i> {{$post->created_at->format('d M, y')}}
                                           </span>
                                     </div>
                                  </li>
                               </ul>
                            @endforeach
                         </div>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h6 class="sidebar-title">Kategoriyalar</h6>
                            <ul class="n-sidebar-categories">
                                @if(!empty($_GET['category']))
                                    @php
                                        $filter_cats=explode(',',$_GET['category']);
                                    @endphp
                                @endif
                                <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    {{-- {{count(Helper::postCategoryList())}} --}}
                                    @foreach(Helper::postCategoryList('posts') as $cat)
                                    <li>
                                        <a href="{{route('blog.category',$cat->slug)}}">
                                            <div class="single-category p-relative mb-10">
                                                {{$cat->title}}
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h6 class="sidebar-title">Teglar</h6>
                            @if(!empty($_GET['tag']))
                                @php
                                    $filter_tags=explode(',',$_GET['tag']);
                                @endphp
                            @endif
                            <form action="{{route('blog.filter')}}" method="POST">
                                @csrf
                                @foreach(Helper::postTagList('posts') as $tag)
                                <div class="dktags">
                                    <a class="single-tag" href="{{route('blog.tag',$tag->title)}}">{{$tag->title}}</a>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
       </div>
    </div>
 </div>
 <!-- news-detalis-area-end  -->
@endsection
