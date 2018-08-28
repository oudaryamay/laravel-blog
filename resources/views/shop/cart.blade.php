@extends('main')
@section('title','| Cart')
@section('content')

 <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Cart</h1>
        </div>
      </section>

<section id="cart_items">
  
        <div class="table-responsive cart_info">
        	<?php  //echo '<pre>'; print_r($cart); echo '</pre>';  ?>
            @if(count($cart))
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Item Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td class="cart_product">
                            <a href="{{ route('shop.single', $item->options->slug) }}">

                        <?php if ($item->options->image != null ) { ?>
							<img height="100" width="100" src="{{url('/uploads/' . $item->options->image)}}" />
						<?php } else { ?>
							<img src="http://placehold.it/100x100/e0e0e0" />
						<?php } ?>

                        </td>
                        <td class="cart_description">
                            <h4><a href="{{ route('shop.single', $item->options->slug) }}">{{$item->name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>&#x20B9 {{$item->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="idcart cart_quantity_up" href='{{url("cart?product_id=$item->id&increment=1")}}'> + </a>

                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2" disabled>
                                <a class="idcart cart_quantity_down" href='{{url("cart?product_id=$item->id&decrease=1")}}'> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">&#x20B9 {{$item->subtotal}}</p>
                        </td>
                        <td class="cart_delete">
                            <a href='{{url("cart?product_id=$item->id&delete=1")}}' class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                <p>You have no items in the shopping cart.</p>
                @endif
                </tbody>
            </table>
        </div>
 
</section> <!--/#cart_items-->
<hr>
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
			<a class="btn btn-outline-dark btn-block " href="/shop">Continue Shopping</a>
			<a class="btn btn-outline-danger btn-block clear" href="{{url("cart?clearcart=1")}}">Clear Cart</a>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <button type="button" class="btn btn-primary btn-block">
					  Total <span class="badge badge-light">&#x20B9 {{Cart::total()}}</span>
					</button>
                
                     <a class="btn btn-success btn-block check_out" href="/checkout">Proceed to Check Out</a>
                	
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
<style>
.idcart, .idcart:hover{
background-color: #28a745;
color: white;
padding: 5px 10px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 15px;
font-weight: bold;
}
.cart_quantity_input {
width: 20%;
text-align: center;
}
</style>
@endsection