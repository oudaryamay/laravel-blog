@extends('main')

@section('title', '| Show all post')

@section('content')

 <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">All Blogs</h1>
        </div>
      </section>

      <div class="album py-5">
        <div class="container">

		@foreach ($posts as $post)
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h5>{{ $post->title }}</h5>
			<p>Published: {{ date('M j, Y', strtotime($post->created_at)) }}</p>

			<p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : "" }}</p>

			<a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>
			<hr>
		</div>
	</div>
	@endforeach

	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>

        </div>
      </div>

@endsection