@extends('layouts.app')

@section('content')

<div class="slider">
  @if(!empty($posts))
    @foreach($posts as $post)
      <div>
          <a href="{{ url('post/'.$post->slug) }}">
            <img src="{{ asset('/img/posts/'.$post->photo['filename']) }}" />
          </a>
      </div>
    @endforeach
  @endif
</div>

@if(!empty($postsOther))
 <div class="container">
    <div class="row justify-content-center">
          <div class="col-md-8">
              <h3>Recent</h3>
              <div class="row">
                  @foreach($postsOther as $other)
                      <div class="col-md-6">
                        <div class="post-item">
                         <div class="post-date">
                          Created: 
                          {{  $other->created_at->diffForHumans() }}
                         </div>
                          <div class="post-date2">
                              <div class="category">
                                  <span>Category:</span> {{ $post->category['name'] }}
                              </div>
                              <div class="name">
                                <a href="{{ url('post/'.$other->slug) }}"><span>Name:</span>  {{ $other->name }}</a>
                              </div>
                              <div class="desc">
                                  {{ str_limit(strip_tags($other->review), 100) }} ...
                              </div>
                          </div>
                        </div>
                      </div>
                  @endforeach
              </div>
          </div>
          <div class="col-md-4">
              <div class="populars">
                @if(!empty($populars))
                <h3>Popular</h3>
                <div class="popular-item">
                  @foreach($populars as $popular)
                        <div>
                          <a href="{{ url('post/'.$popular->slug) }}">{{ $popular->name }} ({{ $popular->views }})</a>
                        </div>
                      @endforeach
                  </div>
                @endif
              </div>
              <div class="users">
                  <h3>Users</h3>
                  @if(!empty($users))
                    @foreach($users as $user)
                      <div class="user-role-{{ $user->role['name'] }} user-status-{{ $user->active }}">
                        {{ $user->name }}
                        @if($user->role['name']=="admin")
                          (admin)
                        @endif
                        @if($user->active=="2")
                          (no_active)
                        @endif
                      </div>
                    @endforeach
                  @endif
              </div>
          </div>
    </div>
 </div>
@endif
@endsection

@section('footer-scripts')
  <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function()
    {
        $('.slider').slick({
          slidesToShow: 5,
          slidesToScroll: 5,
          dots: true,
          infinite: true,
          cssEase: 'linear'
        });
    });
  </script>
@endsection

