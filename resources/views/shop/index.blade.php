@extends('main')

@section('title', '| Show all product')

@section('content')

 <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">All Products</h1>
        </div>
      </section>

      <div class="album py-5">
        <div class="container">
			<div class="row selected-classifieds">
		@foreach ($products as $product)

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="thumbnail">
			<a href="{{ route('shop.single', $product->slug) }}">
				<?php if ($product->image != null ) { ?>
				<img src="{{url('/uploads/' . $product->image)}}" />
			<?php } else { ?>
				<img src="http://placehold.it/400x400/e0e0e0" />
			<?php } ?>
			</a>
			<div class="caption">
			<p><a href="{{ route('shop.single', $product->slug) }}">{{ $product->title }}</a></p>	
			<p>&#x20B9; {{ $product->price }}</p>
			</div>
		</div>
	</div>

	@endforeach
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				{!! $products->links() !!}
			</div>
		</div>
	</div>

        </div>
      </div>
<style>
<style>
div.thumbnail {
  width: 80%;
  background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-bottom: 25px;
}

div.caption  {
  text-align: center;
  padding: 10px 20px;
}
</style>
</style>

@endsection