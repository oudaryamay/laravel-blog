<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

use Cart;

use App\Product;

class ShopController extends Controller
{
    public function getIndex() {

    	$products = Product::paginate(10);
    	return view('shop.index')->withProducts($products);

    }

    public function getSingle($slug) {

    	//Get slug from db
    	$product= Product::where('slug' ,'=', $slug)->first();
    	//return the view and pass in the post object
    	return view ('shop.single')->withProduct($product);
    }

public function cart() {
    //update/ add new item to cart
    if (Request::isMethod('post')) {
        $product_id = Request::get('product_id');
        $product = Product::find($product_id);
        Cart::add(array('id' => $product_id, 'name' => $product->title, 'qty' => 1, 'price' => $product->price, 'options' => ['image' => $product->image, 'slug' => $product->slug]));
    }

    //increment the quantity
    if (Request::get('product_id') && (Request::get('increment')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($rowId[0]);

        Cart::update($rowId[0], $item->qty + 1);

    }

    //decrease the quantity
    if (Request::get('product_id') && (Request::get('decrease')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($rowId[0]);

        Cart::update($rowId[0], $item->qty - 1);
    }

    //delete cart item
    if (Request::get('product_id') && (Request::get('delete')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        Cart::remove($rowId[0]);
    }

    //clear cart
     if (Request::get('clearcart') == 1) {
        Cart::destroy();
    }

    $cart = Cart::content();

    return view('shop.cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function checkout(){
        return view('shop.checkout'); 
    }
}
