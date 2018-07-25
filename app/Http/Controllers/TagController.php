<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tag;

use Session;


class TagController extends Controller
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
        $tags = Tag::orderBy('id', 'DESC')->paginate(10);
         return view('admin.post.tag.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate value
        $this->validate($request, array(
            'name' => 'required|max:255',
            'slug' => 'required|alpha-dash|min:3|max:255|unique:tags,slug'
        ));

        //prepare for store
        $tag = new Tag;

        $tag->name = $request->name;
        $tag->slug = $request->slug;

        //save
        $tag->save();

        //success message
        session::flash('success', 'The tag has been successfully created.');

        //redirect
        return redirect()->route('tags.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find id
        $tag = Tag::find($id);
        //send value to form model
        return view ('admin.post.tag.update')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find id
        $tag = Tag::find($id);
        //send value to form model
        return view ('admin.post.tag.update')->withTag($tag);
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

        $tag=Tag::find($id);

        //validate

        if ($request->input('slug') == $tag->slug) {

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

        $tag=Tag::find($id);

        $tag->name=$request->input('name');
        $tag->slug=$request->input('slug');

        $tag->save();

        Session::flash('success', 'The tag has been successfully updated.');
 
        return view('admin.post.tag.update')->withTag($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        Session::flash('success','The tag was successfully deleted.');
        return redirect()->route('tags.store');
    }
}
