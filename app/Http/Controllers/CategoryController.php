<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use Session;

class CategoryController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view ('admin.post.category.index')->withCategories($categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'slug' => 'required|alpha-dash|min:3|max:255|unique:categories,slug'
        ));

        $category = new Category;

        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->save();

        Session::flash('success', 'New category has been successfully saved.');

        return redirect()->route('categories.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $category=Category::find($id);
        return view('admin.post.category.update')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category=Category::find($id);
        return view('admin.post.category.update')->withCategory($category);
        
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

        $category=Category::find($id);

        //validate

        if ($request->input('slug') == $category->slug) {

        $this->validate($request, array(

            'name' => 'required|max:255'
        ));

        } else {

        $this->validate($request, array(
            'name' => 'required|max:255',
            'slug' => 'required|alpha-dash|min:5|max:255|unique:categories,slug'
        ));

        }
        //store

        $category=Category::find($id);

        $category->name=$request->input('name');
        $category->slug=$request->input('slug');

        $category->save();

        Session::flash('success', 'The category has been successfully updated.');
 
        return view('admin.post.category.update')->withCategory($category);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success','The category was successfully deleted.');
        return redirect()->route('categories.store');
    }
}
