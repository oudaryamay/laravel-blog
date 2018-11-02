<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

use Purifier;

use Session;

use Image;

class ProductController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.product.products')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(

            'productname' => 'required|max:255',
            'slug'        => 'required|alpha-dash|min:2|max:255|unique:products,slug',
            'price'       => 'required|numeric',
            'description' => 'required'     

        ));
        //Store
        $product = new Product;

        $product->title = $request->productname;
        $product->slug = $request->slug;
        $product->description = Purifier::clean($request->description);
        $product->price = $request->price;

        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(400, 400)->save($location);

          $product->image = $filename;
        }

        $product->save(); 

         //Success message
        Session::flash('success', 'The product was successfully created.');
        //redirect
        return redirect()->route('ob-admin.products.edit', $product->id); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get the id
        $product = Product::find($id);

        //validation
        if($request->input('slug') == $product->slug){

            $this->validate($request, array(

            'title' => 'required|max:255',
            'price'       => 'required|numeric',
            'description' => 'required'     

        ));

        } else {

            $this->validate($request, array(

            'title' => 'required|max:255',
            'slug'        => 'required|alpha-dash|min:2|max:255|unique:products,slug',
            'price'       => 'required|numeric',
            'description' => 'required'     

        ));

        }

        $product = Product::find($id);

        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->description = Purifier::clean($request->description);
        $product->price = $request->price;

        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(400, 400)->save($location);

          $product->image = $filename;
        }

        $product->save(); 

         //Success message
        Session::flash('success', 'The product was successfully updated.');
        //redirect
        return redirect()->route('ob-admin.products.edit', $product->id); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);

        $product->delete();

        Session::flash('success','The product was successfully deleted.');

        return redirect()->route('ob-admin.products.index');
    }
}
