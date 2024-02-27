@foreach($comments as $comment)
{{-- {{dd($comments)}} --}}
<ul>
    <li>
       <div class="comments-box">
             <div class="comments-avatar">
                @if($comment->user_info['photo'])
                <img src="{{$comment->user_info['photo']}}" alt="#">
                @else
                <img src="{{asset('backend/img/avatar.png')}}" alt="">
                @endif
             </div>
             <div class="comments-text">
                {{-- {{$post}} --}}
                <div class="avatar">
                   <h6 class="avatar-name">{{$comment->user_info['name']}}</h6>
                </div>
                <span class="post-meta"><i class="fal fa-calendar-alt"></i> {{$comment->created_at->format('M d Y')}}</span>
                <p>{{$comment->comment}}</p>
             </div>
       </div>
    </li>
 </ul>    
@endforeach