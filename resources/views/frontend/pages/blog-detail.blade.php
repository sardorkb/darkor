@extends('frontend.layouts.master')

@section('title','E-TECH || Blog Detail page')

@section('main-content')
<div class="page-banner-area page-banner-height-2" data-background="{{$post->photo}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-banner-content text-center">
                    <h4 class="breadcrumb-title">{{$post->title}}</h4>
                    <div class="breadcrumb-two">
                        <nav>
                           <nav class="breadcrumb-trail breadcrumbs">
                              <ul class="breadcrumb-menu">
                                 <li class="breadcrumb-trail">
                                    <a href="{{route('home')}}"><span>Bosh sahifa</span></a>
                                 </li>
                                 <li class="trail-item">
                                    <span>{{$post->title}}</span>
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
<div class="news-detalis-area mt-120 mb-70">
    <div class="container">
       <div class="row">
          <div class="col-xl-8 col-lg-8">
            <div class="news-detalis-content mb-50">
                <ul class="blog-meta mb-20">
                    <li><a href="#"><i class="fal fa-user"></i>{{$post->author_info['name']}}</a></li>
                   <li><a href="#"><i class="fal fa-comments"></i> ({{$post->allComments->count()}}) Comments</a></li>
                   <li><a href="#"><i class="fal fa-calendar-alt"></i> {{$post->created_at->format('d M, y')}}</a></li>
                </ul>
                <div class="news-thumb mt-40">
                   <img src="{{$post->photo}}" alt="{{$post->photo}}" class="img-fluid">
                </div>
                <p class="mt-25 mb-50">{!! ($post->description) !!}</p>
                <div class="news-quote-area mt-55 text-center">
                   <i class="fas fa-quote-left"></i>
                   @if($post->quote)
                   <h5 class="news-quote-title mt-25">{!! ($post->quote) !!}</h5>
                   @endif
                </div>


                <div class="post-comments mt-60">
                   <h6 class="post-comment-title mb-40">({{$post->allComments->count()}}) Komment</h6>
                   <div class="latest-comments">
                         <!-- Single Comment -->
                         @include('frontend.pages.comment', ['comments' => $post->comments, 'post_id' => $post->id, 'depth' => 3])
                         <!-- End Single Comment -->
                   </div>
                </div>
                <div class="post-comment-form mt-20">
                   <h4 class="post-comment-form-title mb-40">Komment qoldiring</h4>
                   <form class="form comment_form" id="commentForm" action="{{route('post-comment.store',$post->slug)}}" method="POST">
                        @csrf
                       <div class="input-field">
                           <i class="fal fa-pencil-alt"></i>
                           <textarea name="comment" id="comment" placeholder="Komentingizni kiriting...." rows="10"></textarea>
                           <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="parent_id" id="parent_id" value="" />
                       </div>
                       <div class="input-field">
                           <i class="fal fa-user"></i>
                           <input type="text" name="name" placeholder="F.I.SH." required="required">
                       </div>
                       <div class="input-field">
                           <i class="fal fa-envelope"></i>
                           <input ttype="email" name="email" placeholder="E-pochta" required="required">
                       </div>
                       <button class="post-comment shutter-btn" type="submit"><i class="fal fa-comments"></i>Komment qoldirish
                           </button>
                   </form>
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
    </section>
    <!--/ End Blog Single -->
@endsection
@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
@endpush
@push('scripts')
<script>
$(document).ready(function(){

    (function($) {
        "use strict";

        $('.btn-reply.reply').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').hide();
            $('.comment_btn.reply').show();

            $(this).hide();
            $('.btn-reply.cancel').hide();
            $(this).siblings('.btn-reply.cancel').show();

            var parent_id = $(this).data('id');
            var html = $('#commentForm');
            $( html).find('#parent_id').val(parent_id);
            $('#commentFormContainer').hide();
            $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
          });

        $('.comment-list').on('click','.btn-reply.cancel',function(e){
            e.preventDefault();
            $(this).hide();
            $('.btn-reply.reply').show();

            $('.comment_btn.reply').hide();
            $('.comment_btn.comment').show();

            $('#commentFormContainer').show();
            var html = $('#commentForm');
            $( html).find('#parent_id').val('');

            $('#commentFormContainer').append(html);
        });

 })(jQuery)
})
</script>
@endpush
