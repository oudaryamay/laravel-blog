@extends('main')
@section('title','| Show product')
@section('content')

 <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Products Details</h1>
        </div>
      </section>

      <div class="row">
          <div class="product col-md-5 service-image-left">
                    
            <center>
            <?php if ($product->image != null ) { ?>
				<img id="item-display" src="{{url('/uploads/' . $product->image)}}" />
			<?php } else { ?>
				<img id="item-display" src="http://placehold.it/400x400/e0e0e0" />
			<?php } ?>
            </center>
          </div>
     

        <div class="col-md-7">
          <div class="product-title">{{ $product->title }}</div>
          <div class="product-desc">{!! $product->description !!}</div>
          <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
          <hr>
          <div class="product-price">&#x20B9 {{ $product->price }}</div>
          <div class="product-stock">In Stock</div>
          <hr>
          <div class="btn-group cart">
          	<form method="POST" action="{{url('cart')}}">
          	{!! Form::open(array('route' => 'shop.cart')) !!}
          	<input type="hidden" name="product_id" value="{{$product->id}}">
            {{ Form::submit('Add to cart', array('class' => 'btn btn-success')) }}
        	{!! Form::close() !!}
            </div>
          <div class="btn-group wishlist">
            <button type="button" class="btn btn-danger">
              Add to wishlist 
            </button>
          </div>
        </div>
      </div>

<style>
.product>img{
  max-width: 230px;
}

.product-rating{
  font-size: 20px;
  margin-bottom: 25px;
}

.product-title{
  font-size: 20px;
}

.product-desc{
  font-size: 14px;
}

.product-price{
  font-size: 22px;
}

.product-stock{
  color: #74DF00;
  font-size: 20px;
  margin-top: 10px;
}
.service-image-left {
  padding-right: 50px;
}
</style>

@endsection