<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

use Cart;

use App\Product;

use Auth;

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
        $user_id = Auth::id();
        if($user_id != null) {
        //Cart::store($user_id);
        //Cart::instance('default')->store($user_id);

        $product_id = Request::get('product_id');
        $product = Product::find($product_id);
        Cart::add(array('id' => $product_id, 'name' => $product->title, 'qty' => 1, 'price' => $product->price, 'options' => ['image' => $product->image, 'slug' => $product->slug]));
        } else {
        return redirect('/register');    
        }
    }

    //increment the quantity
    if (Request::get('product_id') && (Request::get('increment')) == 1) {
        $rowId = Cart::search(function($key, $value) { return $key->id == Request::get('product_id'); });
        //echo '<pre>'; print_r($rowId); echo '</pre>';
        foreach($rowId as $item) {
            $id = $item->rowId;
            $qty = $item->qty;
               }
        //exit;
        Cart::update($id, $qty + 1);
        return redirect('/cart');

    }

    //decrease the quantity
    if (Request::get('product_id') && (Request::get('decrease')) == 1) {
        $rowId = Cart::search(function($key, $value) { return $key->id == Request::get('product_id'); });
        foreach($rowId as $item) {
            $id = $item->rowId;
            $qty = $item->qty;
               }

        Cart::update($id, $qty - 1);
        return redirect('/cart');
    }

    //delete cart item
    if (Request::get('product_id') && (Request::get('delete')) == 1) {
      $rowId = Cart::search(function($key, $value) { return $key->id == Request::get('product_id'); });
        foreach($rowId as $item) {
            $id = $item->rowId;
         }
        Cart::remove($id );
        return redirect('/cart');
    }

    //clear cart
     if (Request::get('clearcart') == 1) {
        Cart::destroy();
        return redirect('/cart');
    }

    $cart = Cart::content();

    return view('shop.cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function checkout(){
        return view('shop.checkout'); 
    }
}
