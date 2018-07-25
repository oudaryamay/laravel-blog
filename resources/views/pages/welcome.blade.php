@extends('main')
@section('title','| Homepage')
@section('content')

<div class="w-post-list">
  @foreach ($posts as $post)
 <div class="w-dyn-item">
   <div class="post-wrapper">
      <div>
         <a class="blog-title-link w-inline-block" href="{{ route('blog.single', $post->slug)}}">
            <h1 class="blog-title">{{ $post->title }} </h1>
         </a>
         <div class="post-info-wrapper">
            <div class="post-info">{{date('M j, Y', strtotime($post->created_at))}}</div>
            <div class="post-info">|</div>
            <a class="post-info when-link" href="/categories/music">Music</a>
         </div>
         <p class="post-summary">{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : "" }}</p>
         <a class="button-round w-button" href="{{ route('blog.single', $post->slug)}}">Continue reading →</a>
      </div>
   </div>
</div>
@endforeach
</div>
<div class="button-wrapper"><a class="button w-button" href="/all-posts">More posts&nbsp;→</a></div>
@stop