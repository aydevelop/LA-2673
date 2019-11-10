@extends('layouts.app')

@section('content')
   <div class="container post_container">
       <div class="row justify-content-center">
                <div class="col-md-12 show-post">
                    <div class="date">
                        {{ $post->created_at->format('M d Y') }}
                    </div>
                    <div class="title">
                    </div>
                    <div class="reviewer_top">
                        Created by 
                        <span>
                            {{ $post->user->name }}
                        </span>
                    </div>
                    <div class="post_views">
                        Views:
                        <span>
                                {{ $post->views }}
                        </span>
                    </div>
                    <div class="review_container">
                        <div class="review-title"><h2>{{ $post->name }}</h2></div>
                        <hr />
                        
                        <div class="review_container_show">
                            <img src="{{ asset('img/posts/'.$post->photo['filename']) }}" alt=""> 
                            <div>
                                {!! html_entity_decode($post->review) !!}
                            </div>
                        </div>
                    </div>
                </div>
       </div>
   </div>
@endsection