<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
}
