<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;

use Purifier;

use Session;

use Image;

class pageController extends Controller
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
        $pages= Page::orderBy('id', 'desc')->paginate(10);
        return view ('admin.page.pages')->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.page.create');
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
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha-dash|min:5|max:255|unique:pages,slug',
            'body'        => 'required',
        ));

        $page = new Page;

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = Purifier::clean($request->body);

          if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);

          $page->image = $filename;
        }

        $page->save(); 

        Session::flash('success', 'The page was successfully saved.');

        //redirect
        return redirect()->route('ob-admin.pages.show', $page->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit')->withPage($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit')->withPage($page);
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
        //Get the id
        $page = Page::find($id);

        //Validate value
         if ($request->input('slug') == $page->slug) {

            $this->validate($request, array(

            'title'         => 'required|max:255',
            'content'          => 'required'
        ));
        } else {

             $this->validate($request, array(

            'title'         => 'required|max:255',
            'slug'          => 'required|alpha-dash|min:5|max:255|unique:pages,slug',
            'content'          => 'required'
            ));

        }

        //store in variable

        $page= Page::find($id);

        $page->title=$request->input('title');
        $page->slug = $request->input ('slug');
        $page->content= Purifier::clean($request->input('content'));
        
        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);

          $page->image = $filename;
        }

        $page->save();
        
        Session::flash('success','The page was successfully updated.');

        //redirect

        return redirect()->route('ob-admin.pages.show', $page->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $page=Page::find($id);
      
        $page->delete();

        Session::flash('success','The page was successfully deleted.');

        return redirect()->route('ob-admin.pages.index');
    }
}
